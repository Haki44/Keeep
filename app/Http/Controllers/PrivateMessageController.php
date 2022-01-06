<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\PrivateMessage;
use App\Notifications\PrivateMessageNotification;
use App\Providers\RouteServiceProvider;

class PrivateMessageController extends Controller
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
}
