<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TradeEnded extends Notification
{
    use Queueable;

    public $offer;
    public $reply;
    public $user_to;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $user_to, $user_from)
    {
        $this->reply = $reply;
        $this->user_to = $user_to;
        $this->user_from = $user_from;
        $this->offer = Offer::where('id', $reply->offer_id)->first();
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
        return (new MailMessage)
                ->subject('Transaction terminée ' . $this->user_to->firstname)
                ->greeting('Bonjour ' . $this->user_to->firstname . ',')
                ->line('La transaction pour l\'offre ' . $this->offer->name . ' avec ' . $this->user_from->firstname . ' est terminée.')
                ->line('A bientôt,')
                ->salutation('L\'équeeep');
    
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
