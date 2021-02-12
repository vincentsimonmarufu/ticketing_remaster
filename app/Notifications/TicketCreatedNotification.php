<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    private $created;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($created)
    {
        $this->created = $created;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->greeting($this->created['greeting'])
                    ->subject('A ticket has been opened')
                    ->line($this->created['body'])
                    ->line($this->created['name'])
                    ->line($this->created['email'])
                    ->line($this->created['contact'])
                    ->line($this->created['subject'])
                    ->line($this->created['description'])
                    ->action($this->created['actionText'],$this->created['actionUrl'])
                    ->line($this->created['thanks']);
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

    public function toDatabase($notifiable){
        return [
            'data' => $this->created['body'],
            'message'=>$this->created['message']
        ];
    }
}
