<?php

namespace Laravelevents\ImEvents\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class ImeventNotified extends Notification implements ShouldQueue
{
    use Queueable;
    protected $imevent, $inviteeuser;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($imevent, $inviteeuser)
    {
      $this->imevent = $imevent;
      $this->inviteeuser = $inviteeuser;
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
         $url = url('/calendar/event/'.$this->imevent->id.'/view');

         if($this->imevent->status == 2){
             return (new MailMessage)
                 ->subject('Event has been cancelled')
                 ->greeting('Hello ' . $this->inviteeuser->name . ',')
                 ->line($this->imevent->subject.' has ben canceled by its ownwer')
                 ->line('Thank you for using our application!');
         }else {
             return (new MailMessage)
               ->subject('Event Invitation From ' . $this->imevent->user->name )
               ->greeting('Hello ' . $this->inviteeuser->name . ',')
               ->line($this->imevent->subject)
               ->line("Event Date")
               ->line("from : " . $this->imevent->start_date . " To :" . $this->imevent->end_date)
               ->line("Location: ".$this->imevent->location)
               ->line("")
               ->line("Description")
               ->line($this->imevent->description)
               ->action('View Event', $url);
         }
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
