<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;

class OffersList extends Component
{
    // Permet de dire qu'un système de pagination est présent et du coup de le transformer en AJAX (Eviter de refresh toute la page)
    
    use WithPagination;

    // Valeur qui est rentrée dans le champ de recherche 
    public $search = '';


    // Récupération de toutes les offres correspondant au champ de recherche
    public function render()
    {
        return view('livewire.offers-list', [
            'offers' => Offer::
            where('name', 'LIKE', "%{$this->search}%")->paginate(6)
        ]);
    }
}
