<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\ImEvents as ImEvents;

class SendEventRemainderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:eventremainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       $imevents =ImEvents::all()->get();

        foreach($imevents as $imevent) {

           foreach($imevent->invitees as $invitee) {
               // Send the email to user
               \Mail::queue('laravelevents.emails.eventremainder', ['event' => $imevent], function ($mail) use ($user) {
                   $mail->to($invitee->user->email)
                       ->from($imevent->user->email, $imevent->user->name)
                       ->subject("Remainder:".$imevent->subject);
               });
           }

        }

        $this->info('Remainder messages sent successfully!');
    }
}
