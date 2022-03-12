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
        $users = PrivateMessage::where('from_id', auth()->user()->id)->orderBy('created_at')->distinct()->get();
        $users = $users->groupBy('to_id');


        return view('livewire.conversations-list', [
            'users' => User::whereIn('id', $users)->get()
        ]);
    }
}
