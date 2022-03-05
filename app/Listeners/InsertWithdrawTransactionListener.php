<?php

namespace App\Listeners;

use App\Events\AddWithdrawTransactionEvent;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InsertWithdrawTransactionListener
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
     * @param  \App\Events\AddWithdrawTransactionEvent  $event
     * @return void
     */
    public function handle(AddWithdrawTransactionEvent $event)
    {
        // On sélectionne l'user qui a posté l'offre et celui qui a répondu à l'offre
        $offer_and_reply_user = User::findMany([$event->reply->offer->user_id, $event->reply->user_id]);

        // On calcule la somme à prélever en fonction de la quantité
        $amount = $event->reply->offer->price * $event->reply->quantity;

        Transaction::create([
            'type' => 'debit',
            'offer_id' => $event->reply->offer->id,
            'offer_name' => $event->reply->offer->name,
            'offer_user_id' => $event->reply->offer->user_id,
            'reply_user_id' => $event->reply->user_id,
            'offer_amount' => $amount,
            'offer_user_amount' => $offer_and_reply_user[0]->kips,
            'reply_user_amount' => $offer_and_reply_user[1]->kips,
        ]);

        // On prélève
        User::where('id', $event->reply->user_id)->decrement('kips', $amount);
    }
}
