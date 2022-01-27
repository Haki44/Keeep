<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptedOfferNotification extends Notification
{
    use Queueable;

    public $offer;
    public $user_from;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer, $user_from)
    {
        $this->offer = $offer;
        $this->user_from = $user_from;
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
        return (new MailMessage)->markdown('emails.private-message', ['offer' => $this->offer, 'user_from' => $this->user_from])
                                ->subject('Offre acceptée !' . $this->offer->name);
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
