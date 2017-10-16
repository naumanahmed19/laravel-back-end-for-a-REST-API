<?php

namespace App\Notifications;

use App\Apartment;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApartmentPosted extends Notification
{
    use Queueable;

    protected $apartment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Apartment $apartment)
    {
        $this->apartment = $apartment;
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
                ->subject('New apartment Posted | '. $this->apartment->title)
                ->greeting('Hello,')
                ->line('Your new apartment has been saved and publish. Here are details.')
                ->line('apartment ID: '.$this->apartment->id)
                ->line('apartment Name: '. $this->apartment->title)
                ->action('Edit Apartment',  route('apartments.edit', [
                        'id' => $this->apartment->id,
                        'token'=> $this->apartment->token
                    ]
                ))
                ->line('Want to delete this apartment?')
                ->action('Delete Apartment',  route('apartments.destroy', [
                        'id' => $this->apartment->id,
                        'token'=> $this->apartment->token
                    ]
                ))
                ->line('Thank you.');
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
