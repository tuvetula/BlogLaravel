<?php

namespace App\Notifications;

use App\Models\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageReceived extends Notification
{
    use Queueable;
    /**
     * @var Messages
     */
    private $messages;

    /**
     * Create a new notification instance.
     *
     * @param Messages $messages
     */
    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('tuvetula@gmail.com')
                    ->subject('Nouveau message')
                    ->line($this->messages->user->name.' '.$this->messages->user->first_name.' vous a envoyé un message')
                    ->line($this->messages->content)
                    ->action('Voir le message', route('messages.show' , $this->messages->from_id));
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
