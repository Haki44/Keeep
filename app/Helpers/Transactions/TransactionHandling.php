<?php
namespace App\Helpers\Transactions;

use App\Models\Offer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Tous les helpers sur les transactions
 *
 */
class TransactionHandling {

    /**
     * Helper qui enregistre la transaction
     *
     * @param Offer $offer
     * @param $reply_user_id
     * @return bool
     *
     */
    public function make_transaction(Offer $offer, $reply_user_id): bool
    {
        DB::transaction(function () use($offer, $reply_user_id){
            Transaction::create([
                'offer_id' => $offer->id,
                'offer_user_id' => $offer->user_id,
                'reply_user_id' => $reply_user_id,
                'amount' => $offer->price,
            ]);
        });
        return true;
    }

    /**
     * Helper qui sert à prélever des kips
     *
     * @param Offer $offer
     * @param $reply_user_id
     * @return void
     *
     */
    public function withdraw_kips($user_id, $amount){
        DB::transaction(function () use($user_id, $amount){
            User::where('id', $user_id)->decrement('kips',  $amount);
        });
    }

    /**
     * Helper qui sert à créditer des kips
     *
     * @param Offer $offer
     * @param $reply_user_id
     * @return void
     *
     */
    public function credit_kips($user_id, $amount){
        DB::transaction(function () use($user_id, $amount){
            User::where('id', $user_id)->increment('kips',  $amount);
        });
    }
}
