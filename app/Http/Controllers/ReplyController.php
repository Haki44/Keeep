<?php

namespace App\Http\Controllers;

use App\Notifications\ReplyNotification;
use App\Models\Offer;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Notifications\RefuseResponseNotification;

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
     * @param  Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        if (is_null($reply->is_accepted)) {
            // CS: J'ai changé car a la base il n'y avait pas de softdelete sur le Model.
            // Je l'ai mis car je l'utilise dans la methode refuse. Donc pour toujours supprimer sans softdelete le reply,
            // j'utilise le forceDelete()
            $reply->forceDelete();

            return redirect('dashboard')->with('success', 'Votre réponse a bien été annulée !');
        } else {
            return redirect('dashboard')->with('danger', 'Vous ne pouvez pas annuler votre réponse, celle-ci a déjà été accepté');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function refuse(Reply $reply)
    {
        // Soft delete
        $reply->delete();

        // Envoie d'un mail
        $reply->user->notify(new RefuseResponseNotification($reply));

        return redirect()->route('reply.index')->with('success', 'La réponse à bien été refusée');
    }
}
