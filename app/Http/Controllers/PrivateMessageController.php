<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\PrivateMessage;
use App\Notifications\PrivateMessageNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;


class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // On regroupe tout les messages qui on un 'to_id' indentique
        $users = PrivateMessage::where('from_id', auth()->user()->id)->orderBy('created_at')->distinct()->get();
        $users = $users->groupBy('to_id');

        // On récupere les données des users
        $users = User::whereIn('id', $users)->get();

        return view('private_message.list', compact('users'));
    }
  
    public function index(User $user_to)
    {
        // On récupère les messages envoyés de l'utilisateur connecté a celui qui a créé l'offre
        $PM_sender = PrivateMessage::where('to_id', $user_to->id)->where('from_id', auth()->user()->id)->get();

        // On récupère les messages de l'utilisteur qui a créé l'offre a celui qui est connecté
        $PM_receiver = PrivateMessage::where('to_id', auth()->user()->id)->where('from_id', $user_to->id)->get();

        // On merge les 2 collections de facon ordonné (le plus ancien message en dernier)
        $private_messages = $PM_sender->merge($PM_receiver)->sortByDesc('created_at');

        return view('private_message.index', compact('private_messages', 'user_to'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Offer $offer)
    {
        return view('private_message.create', compact('offer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Offer $offer, Request $request)
    {
        $content = $request->validate([
            'content' => ['required', 'max:255', 'string']
        ],
        [
            'content.required' => 'Vous devez indiquer un message',
            'content.string' => 'Votre message doit être une chaine de caractère',
            'content.max' => 'Votre message ne peut excéder :max caractères'
        ]);

        $ids = [
            'from_id' => auth()->user()->id,
            'to_id' => $offer->user->id
        ];

        $data = array_merge($content, $ids);

        // $message = auth()->user()->messageSends()->create($data);
        // $offer->user->messageReceiveds()->associate($message);

        PrivateMessage::create($data);

        // Envoie d'un mail
        $offer->user->notify(new PrivateMessageNotification(auth()->user(), $offer->user->id, $offer));
        
        // Redirection vers la home avec alert success
        return redirect()->route('offer.show', $offer->id)->with('success', 'Votre message à bien été envoyé à ' . $offer->user->firstname);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request)
    {
        $content = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'to_id' => ['required', 'numeric']
        ],
        [
            'content.required' => 'Vous devez indiquer un message',
            'content.string' => 'Votre message doit être une chaine de caractère',
            'content.max' => 'Votre message ne peut excéder :max caractères',
            'to_id.required' => 'Une erreur est survenue, Merci de rééessayer ultérieurement',
            'to_id.numeric' => 'Une erreur est survenue, Merci de rééessayer ultérieurement'
        ]);

        $ids = [
            'from_id' => auth()->user()->id
        ];

        $data = array_merge($content, $ids);

        PrivateMessage::create($data);

        // Envoie d'un mail
        $user_to = User::findOrFail($request->to_id);
        $user_to->notify(new PrivateMessageNotification(auth()->user(), $user_to));

        // Redirection vers la page de chat
        return redirect()->route('private_message.index', ['user_to' => $request->to_id])->with('success', 'Votre réponse a bien été envoyé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function get_new_messages(){
        $new_messages = PrivateMessage::where('to_id', auth()->user()->id)->limit(5)->get();
        dump($new_messages);
    }
}
