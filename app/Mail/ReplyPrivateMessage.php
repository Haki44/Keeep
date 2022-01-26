<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyPrivateMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;
    public $user_to;
    public $user_from;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($offer, $user_to, $user_from)
    {
        $this->offer = $offer;
        $this->user_to = $user_to;
        $this->user_from = $user_from;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reply-private-message');
    }
}
