<?php

namespace App\Listeners;
use App\Listeners\Request;
use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\ImEvents as ImEvents;
use Auth;
use Session;

class DisplayNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {

        $imeventids =  Invitee::select('imevent_id')->where('user_id', $event->request->user()->id)->pluck('imevent_id')->toArray();
        $imevents = ImEvents::whereIn('id',$imeventids)->get();
        //app('request')->session()->put('test', 'hello world!');
        app('request')->session()->flash('msg','Hey, You have a message to read');
        //dd($imevents);
    }
}
