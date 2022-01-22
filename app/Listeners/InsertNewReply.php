<?php

namespace App\Listeners;

use App\Events\AddReplyEvent;
use App\Jobs\SendConfirmReplyJob;
use App\Models\Reply;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class InsertNewReply
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
     * @param  object  $event
     * @return void
     */
    public function handle(AddReplyEvent $event)
    {

        $data = [
            'user_id' => auth()->user()->id,
            'offer_id' => $event->reply['offer']->id,
            'reply' => $event->reply['reply']
        ];

        // Ajout de la réponse en base de donnée
        $reply = Reply::create($data);

        // Création d'un Job pour envoie de mail à l'auteur de l'offre
        SendConfirmReplyJob::dispatch($event->reply);
    }
}
