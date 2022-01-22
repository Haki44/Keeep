<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Notifications\ReplyNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Offer;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $data = ['user_id' => $offer->user_id, 'offer_id' => $offer->id, 'reply' => $data['reply']];

        Reply::create($data);
        $offer->user->notify(new ReplyNotification($offer, auth()->user(), $data['reply']));

        // Affichage du message de confirmation de l'envoi de l'e-mail et retour à l'accueil
        return redirect(RouteServiceProvider::HOME)->with('success', 'Demande envoyée à ' . $offer['user']->firstname);
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

        $reply = Reply::find($id);
        if (is_null($reply->is_accepted)) {
            $isok = $reply->delete();

            if ($isok) {
                return redirect(RouteServiceProvider::HOME)->with('success', 'Votre répoonse a bien été annulée !');
            }
        } else {
            return redirect(RouteServiceProvider::HOME)->with('danger', 'Vous ne pouvez pas annuler votre réponse, celle-ci a déjà été accepté');
        }
    }
}
