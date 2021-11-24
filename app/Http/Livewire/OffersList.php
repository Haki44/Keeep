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

    // Variable permettant d'afficher ou de cacher la modale de suppression d'offre
    public $showDeleteModal = false;

    // Valeurs permettant la suppression d'une offre 
    public $offer_name = '';
    public $offer_id = null;

    // Ouverture de la modale de suppression tout en récupérant les données
    public function showDeleteModal($offer_id)
    {
        $offer = Offer::find($offer_id);
        $this->offer_id = $offer_id;
        $this->offer_name = $offer->name;

        $this->showDeleteModal = true;
    }

    // Fermeture de la modale de suppression tout en retirant les données stockées
    public function hideDeleteModal()
    {
        $this->showDeleteModal = false;

        $this->offer_id = '';
        $this->offer_name = '';
    }

    // Suppression d'une offre, fermeture de la modale puis retrait des données stockées
    public function deleteOffer() {
        Offer::find($this->offer_id)->delete();

        $this->showDeleteModal = false;

        $this->offer_id = '';
        $this->offer_name = '';
    }

    // Récupération de toutes les offres correspondant au champ de recherche
    public function render()
    {
        return view('livewire.offers-list', [
            'offers' => Offer::
            where('name', 'LIKE', "%{$this->search}%")->paginate(6)
        ]);
    }
}
