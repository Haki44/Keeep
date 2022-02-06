<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\PrivateMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PrivateMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $offer;
    public $user_from;
    public $user_to;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_from, $user_to, $offer = null)
    {
        $this->offer = $offer;
        $this->user_from = $user_from;
        $this->user_to = $user_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Si le PM vient d'une offre, alors on notifie avec l'offre
        if ($this->offer) {
            return (new MailMessage)->markdown('emails.private-message', ['offer' => $this->offer, 'user_from' => $this->user_from])
                                    ->subject('Nouveau message pour votre offre ' . $this->offer->name);
        }
        // Si c'est juste une réponse à partir du chat
        return (new MailMessage)
                        ->markdown('emails.reply-private-message', ['user_to' => $this->user_to, 'user_from' => $this->user_from])
                        ->subject($this->user_from->firstname . ' vous a envoyé un message');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
