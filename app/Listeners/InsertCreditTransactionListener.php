<?php

namespace App\Listeners;

use App\Events\AddCreditTransactionEvent;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class InsertCreditTransactionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AddCreditTransactionEvent  $event
     * @return void
     */
    public function handle(AddCreditTransactionEvent $event)
    {
        DB::transaction(function () use($event){

            // On sélectionne l'user qui a posté l'offre et celui qui a répondu à l'offre
            $offer_and_reply_user = User::findMany([$event->reply->offer->user_id, $event->reply->user_id]);

            // On calcule la somme à créditer en fonction de la quantité
            $amount = $event->reply->offer->price * $event->reply->quantity;

            Transaction::create([
                'type' => 'credit',
                'offer_id' => $event->reply->offer->id,
                'offer_name' => $event->reply->offer->name,
                'offer_user_id' => $event->reply->offer->user_id,
                'reply_user_id' => $event->reply->user_id,
                'offer_amount' => $amount,
                'offer_user_amount' => $offer_and_reply_user[0]->kips,
                'reply_user_amount' => $offer_and_reply_user[1]->kips,
            ]);

            // On crédite
            User::where('id', $event->reply->offer->user_id)->increment('kips', $amount);
        });
    }
}
