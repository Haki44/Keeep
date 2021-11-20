<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterReferentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $referent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $referent)
    {
        $this->referent = $referent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.register-referent');
    }
}
