<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTradeCode extends Notification
{
    use Queueable;

    public $offer;
    public $reply;
    public $user_from;
    public $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $user_from, $code)
    {
        $this->reply = $reply;
        $this->user_from = $user_from;
        $this->code = $code;
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
                    ->subject($this->reply->user->name . 'Voici votre code pour l\'offre Keeep ' . $this->offer->name)
                    ->greeting('Bonjour ' . $this->reply->user->name . ',')
                    ->line('Votre code est le ' . $this->code .', vous devrez le donner à ' . $this->offer->user->name . ' lors de la transaction')
                    ->action('Voir la page de transaction', route('reply.show', $this->reply->id))
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
