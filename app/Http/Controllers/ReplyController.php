<?php

namespace App\Http\Controllers;


use App\Notifications\ReplyNotification;
use App\Models\Offer;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Events\AddReplyEvent;
use App\Models\User;
use App\Notifications\AcceptedOfferNotification;
use App\Notifications\CancelResponseNotification;
use App\Notifications\PrivateMessageNotification;
use App\Providers\RouteServiceProvider;
use App\Notifications\RefuseResponseNotification;
use App\Notifications\SendTradeCode;
use App\Rules\HaveEnoughKips;
use Illuminate\Support\Facades\Auth;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myreplies()
    {
        // Liste des transaction en cours pour l'user (ou il n'est pas propriétaire de l'offre)
        $replies = Reply::where('user_id', Auth::user()->id)->where('status', 1)->get();

        return view('reply.myreplies', compact('replies'));
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
        // Si l'offre n'a pas une tarification fixe, on vérifie puis on prend la quantité
        if($offer->pricing !== 0) {
            $data = $request->validate(
                [
                    'reply' => ['required', 'string'],
                    'quantity' => ['required', 'integer', 'min:1', new HaveEnoughKips($offer->price)]
                ],
                [
                    'reply.required' => 'Vous ne pouvez pas laisser de réponse vide',
                    'reply.string' => 'La réponse doit être une chaine de caractère',
                    'quantity.required' => 'Vous devez indiquer une quantité',
                    'quantity.integer' => 'La quantité doit être un nombre',
                    'quantity.min:1' => 'La quantité doit être supérieure ou égale à 1',
                ]
            );
            $data = ['user_id' =>  auth()->user()->id, 'offer_id' => $offer->id, 'reply' => $data['reply'], 'quantity' => $data['quantity']];
        } else {
            $data = $request->validate(
                [
                    'reply' => ['required', 'string'],
                ],
                [
                    'reply.required' => 'Vous ne pouvez pas laisser de réponse vide',
                    'reply.string' => 'La réponse doit être une chaine de caractère',

                ]
            );
            $data = ['user_id' =>  auth()->user()->id, 'offer_id' => $offer->id, 'reply' => $data['reply']];
        }

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
        $reply = Reply::with('offer')->find($id);

        return view('reply.show', compact('reply'));
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
    public function update($id, $status)
    {
        $reply = Reply::find($id);
        $offer = Offer::find($reply->offer_id);
        $user_to = User::find($reply->user_id);
        // Status 1 => réponse accepté, 0 réponse refusé (le status étant a null de base)
        if($status == 1) {
            // Verification pour etre sur qu'entre temps l'offre n'a pas été retiré ou déja accepté,
            // si une réponse du même utilisateur existe déjà, récupérer la réponse avec la transaction non terminée
            $check = Reply::where('offer_id', $reply->offer_id)->where('status', 1)->where('ended_at', null)->get();

            if ($check->count() < 1 ){

                // On génère les codes
                $starting_code = random_int(1000, 9999);
                // On evite l'enventualité ou les 2 codes serait égaux
                do {
                    $ending_code = random_int(1000, 9999);
                }while($ending_code === $starting_code);

                Reply::where('id', $reply->id)->update([
                    'status' => $status,
                    'starting_code' => $starting_code,
                    'ending_code' => $ending_code,
                ]);

                 // Envoie d'un mail
                $reply->user->notify(new AcceptedOfferNotification($offer, auth()->user(), $reply, $user_to));
                $reply->user->notify(new SendTradeCode($reply, auth()->user(), $starting_code));

                return redirect()->route('reply.index')->with('success', 'Votre réponse a bien été acceptée !');
            } else {
                return redirect()->route('reply.index')->with('success', 'La réponse a déjà été acceptée :(');
            }
        } else {

            // En cas de refus on update avec le refus (0 dans status)
            Reply::where('id', $reply->id)->update([
                'status' => $status,
            ]);

            // Envoie d'un mail
            $reply->user->notify(new RefuseResponseNotification($reply));
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        if (is_null($reply->status)) {
            // CS: J'ai changé car a la base il n'y avait pas de softdelete sur le Model.
            // Je l'ai mis car je l'utilise dans la methode refuse. Donc pour toujours supprimer sans softdelete le reply,
            // j'utilise le forceDelete()
            $reply->forceDelete();
            $reply->user->notify(new CancelResponseNotification($reply));

            return redirect()->route('reply.index')->with('success', 'Votre réponse a bien été annulée !');
        } else {
            return redirect()->route('reply.index')->with('danger', 'Vous ne pouvez pas annuler votre réponse, celle-ci a déjà été acceptée');
        }
    }
}
