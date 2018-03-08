<?php
/**
 * Created by PhpStorm.
 * User: Sakthi
 * Date: 3/6/2018
 * Time: 2:59 PM
 */
namespace Laravelevents\ImEvents\Observers;

use Illuminate\Http\Request;
use Laravelevents\ImEvents\Models\ImEvents as Imevent;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Notifications\InviteeNotified;

class InviteeObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function updated(Invitee $invitee)
    {
        if($invitee->isDirty()) {
            $imevent = ImEvent::where('id',$invitee->imevent_id)->first();
            foreach($imevent->invitees as $otherInvitee) {
                if($otherInvitee->user->id == $invitee->user->id){
                    continue;
                }
                \Notification::send($otherInvitee->user, new InviteeNotified($otherInvitee->user, $invitee, $imevent));
            }
        }
    }
}