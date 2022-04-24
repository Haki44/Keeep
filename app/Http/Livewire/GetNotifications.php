<?php

namespace App\Http\Livewire;

use App\Models\PrivateMessage;
use App\Models\Reply;
use Livewire\Component;

class GetNotifications extends Component
{

    public function render()
    {
        $private_messages = PrivateMessage::where('to_id', auth()->user()->id)->where('is_readed', NUll)->get();

        $replies = Reply::where('user_id', auth()->user()->id)->get();

        return view('livewire.get-notifications', [
            'notifications' => [...$private_messages, ...$replies],
            'notification_count' => count($private_messages) + count($replies)
            ]);

    }

    public function switch_to_readed($id){

        $private_message = PrivateMessage::find($id);

        $private_message->is_readed = 1;

        $private_message->save();
    }
}
