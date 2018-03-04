<?php

namespace Laravelevents\ImEvents\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ImeventNotified extends Notification implements ShouldQueue
{
    use Queueable;
    protected $imevent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($imevent)
    {
      $this->imevent = $imevent;
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
       $url = url('/calander/event/'.$this->imevent->id);
       return (new MailMessage)
                ->greeting('Hello!')
                ->line($this->imevent->description)
                ->action('View Event', $url)
                ->line('Thank you for using our application!');
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
