<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OfferQuantity extends Component
{
    public $offer;
    public $quantity = 1;
    public $total;
    public $error_message = '';

    public function render()
    {
        $this->total = $this->quantity * $this->offer->price;
        return view('livewire.offer-quantity');
    }

    // Check si l'input est validé
    public function modifiedQuantity($input) {
        if($input <= 0 || $input == null) {
            $this->error_message = "Veuillez rentrer un nombre supérieur à 0 !";
        } else {
            $this->quantity = $input;
    
            if(($this->quantity * $this->offer->price) > auth()->user()->kips) {
                $this->error_message = "Vous n'avez pas assez de kips !";
            } else {
                $this->error_message = "";
            }
        }
    }
}
