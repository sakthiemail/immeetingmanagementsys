<?php

namespace Laravelevents\ImEvents\Observers;

use Illuminate\Http\Request;
use Laravelevents\ImEvents\Models\ImEvents as Imevent;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Models\Remainder as Remainder;
use Laravelevents\ImEvents\Notifications\ImeventNotified;

trait ImEventObserveUses
{

    public function createRemainder(Imevent $imevent, Request $request ){
        Remainder::create([
            'imevent_id'=> $imevent->id,
            'interval'=>$this->request->input('remainder_interval'),
        ]);
    }

    public function saveRemainder(Imevent $imevent, Request $request)
    {
        Remainder::where('imevent_id',$imevent->id)->update(['interval' => $this->request->remainder_interval]);
    }

    public function  createInvitees(Imevent $imevent, Request $request)
    {
        $new_users = $this->request->get('userslist');
        foreach($new_users as $uid) {
            Invitee::create([ 'user_id'=> $uid, 'imevent_id'=> $imevent->id ]);
            $user=User::findorfail($uid);
            $this->sendNotification ($imevent, $user);
        }
    }

    public function saveInvitees(Imevent $imevent, Request $request)
    {
        $new_users = $this->request->get('userslist');
        $old_users = Invitee::select('user_id')->where('imevent_id', $imevent->id)
            ->pluck('user_id')
            ->toArray();
        $diff_users = array_diff($old_users, $new_users);

        foreach ($new_users as $uid) {
            $user = User::findorfail($uid);
            $invitee = Invitee::where('user_id', $uid)->where('imevent_id', $imevent->id)->get();
            if ($invitee->count() == null) {
                Invitee::create([ 'user_id' => $uid, 'imevent_id' => $imevent->id ]);
                $this->sendNotification ($imevent, $user);
            }
            $this->sendNotification ($imevent, $user);
        }
        $old_ids = Invitee::select('id')->whereIn('user_id', $diff_users)
            ->where('imevent_id',$imevent->id)
            ->pluck('id')->toArray();
        Invitee::destroy($old_ids);
    }

    public function sendNotification(Imevent $imevent, User $user)
    {
        \Notification::send($user, new ImeventNotified($imevent, $user));
    }

}