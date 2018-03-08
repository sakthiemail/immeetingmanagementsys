<?php

namespace Laravelevents\ImEvents\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InviteeNotified extends Notification implements ShouldQueue
{
    use Queueable;
    protected  $inviteeuser, $invitee, $imevent ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inviteeuser, $invitee, $imevent)    {

        $this->inviteeuser = $inviteeuser;
        $this->invitee = $invitee;
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
       // dd($this->invitee);
        return (new MailMessage)
            ->greeting('Hello ' .  $this->inviteeuser->name . ',')
            ->line($this->invitee->user->name.' has sent his/her status for the event '.$this->imevent->subject)
            ->line("Status : ".$this->invitee->accept_status)
            ->line($this->invitee->message)
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
