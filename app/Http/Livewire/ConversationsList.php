<?php

namespace App\Http\Livewire;

use App\Models\PrivateMessage;
use App\Models\User;
use Livewire\Component;

class ConversationsList extends Component
{
    public $search = '';

    public function render()
    {
        // On regroupe tout les messages qui on un 'to_id' indentique
        $users = PrivateMessage::where('to_id', auth()->user()->id)->orderBy('created_at')->distinct()->get();
        // On met en index les id des from_id
        $users = $users->groupBy('from_id');
        // On va chercher les users grace aux index des from_id, couplé avec la recherche de la search bar
        $users = User::where('firstname', 'LIKE', "%{$this->search}%")->whereIn('id', array_keys($users->toArray()))->get();

        return view('livewire.conversations-list', [
            'users' => $users
        ]);
    }
}
