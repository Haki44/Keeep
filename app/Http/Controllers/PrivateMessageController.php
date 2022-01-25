<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\PrivateMessage;
use App\Providers\RouteServiceProvider;
use App\Notifications\PrivateMessageNotification;

class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        // On récupère les messages envoyé de l'utilisateur connecté a celui qui a créé l'offre
        $PM_sender = PrivateMessage::where('to_id', $user->id)->where('from_id', auth()->user()->id)->get();

        // On récupère les messages de l'utilisteur qui a créé l'offre a celui qui est connecté
        $PM_receiver = PrivateMessage::where('to_id', auth()->user()->id)->where('from_id', $user->id)->get();

        // On merge les 2 collections de facon ordonné (le plus ancien message en dernier)
        $private_messages = $PM_sender->merge($PM_receiver)->sortByDesc('created_at');

        return view('private_message.index', compact('private_messages', 'user'));
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
            'content.max' => 'Votre message ne peut excéder :max caractères',
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
        $offer->user->notify(new PrivateMessageNotification($offer, auth()->user()));

        // Redirection vers la home avec alert success
        return redirect()->route('offer.show', $offer->id)->with('success', 'Votre message à bien été envoyé à ' . $offer->user->firstname);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {

        $offer = Offer::with('user')->findOrFail($offer->id);

        return view('private_message.show', compact('offer'));

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
}
