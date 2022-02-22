<?php
namespace App\Helpers\Transactions;

use App\Models\Offer;


/**
 * Tous les helpers pour la somme de la transaction
 *
 */
class Balance {
    /**
     * Helper qui compare le solde de l'user et la somme de l'offre
     *
     * @param Offer $offer
     * @param $user_balance (solde de l'user)
     *
     * @return bool
     *
     */
    public function verify_user_balance(Offer $offer, $user_balance): bool
    {
        if($user_balance >= $offer->price){
            return true;
        } else {
            return false;
        }

    }
}
