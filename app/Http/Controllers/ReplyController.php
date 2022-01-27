<?php

namespace App\Http\Controllers;

use App\Notifications\ReplyNotification;
use App\Models\Offer;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Events\AddReplyEvent;
use App\Notifications\AcceptedOfferNotification;
use App\Notifications\PrivateMessageNotification;
use App\Providers\RouteServiceProvider;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Les offres du user connecté avec les réponses
        // Le whereRelation prends en paramètres le nom de la relation, le champ de relation et la valeur du champ
        $offers = Offer::whereRelation('user', 'user_id', auth()->user()->id)->get();

        return view('reply.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, Offer $offer)
    {

        $data = $request->validate(
            [
                'reply' => ['required', 'string'],
            ],
            [
                'reply.required' => 'Vous ne pouvez pas laisser de réponse vide',
                'reply.string' => 'La réponse doit être une chaine de caractère'
            ]
        );

        $data = ['user_id' =>  auth()->user()->id, 'offer_id' => $offer->id, 'reply' => $data['reply']];

        Reply::create($data);
        $offer->user->notify(new ReplyNotification($offer, auth()->user(), $data['reply']));

        // Affichage du message de confirmation de l'envoi de l'e-mail et retour à l'accueil
        return redirect('dashboard')->with('success', 'Demande envoyée à ' . $offer->user->firstname);
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
     */
    public function update($id)
    {
        $reply = Reply::find($id);
        $check = Reply::where('offer_id', $reply->offer_id)->where('is_accepted', 1)->get();

        if ($check->count() < 1 ){
            Reply::where('id', $reply->id)->update([
                'is_accepted' => 1,
            ]);

             // Envoie d'un mail
            $reply->user->notify(new AcceptedOfferNotification($reply, auth()->user()));

            return redirect()->route('reply.index')->with('success', 'Votre réponse a bien été accéptée !');
        } else {
            return redirect()->route('reply.index')->with('success', 'La réponse à déjà été accéptée :(');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $reply = Reply::find($id);
        if (is_null($reply->is_accepted)) {
            $reply->delete();

            return redirect()->route('reply.index')->with('success', 'Votre réponse a bien été annulée !');
        } else {
            return redirect()->route('reply.index')->with('danger', 'Vous ne pouvez pas annuler votre réponse, celle-ci a déjà été accepté');
        }
    }
}
