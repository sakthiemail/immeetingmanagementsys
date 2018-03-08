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
use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Models\Remainder as Remainder;
use Laravelevents\ImEvents\Notifications\ImeventNotified;

class ImEventObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function created(Imevent $imevent)
    {
        $new_users = $this->request->get('userslist');

        //dd($userslist);

        Remainder::create([
            'imevent_id'=> $imevent->id,
            'interval'=>$this->request->input('remainder_interval'),
         ]);

        foreach($new_users as $uid) {
            Invitee::create([
                'user_id'=> $uid,
                'imevent_id'=> $imevent->id,
            ]);
            $user=User::findorfail($uid);
           \Notification::send($user, new ImeventNotified($imevent,$user));
        }
    }

    public function updated(Imevent $imevent)
    {
        if($imevent->isDirty()) {
            $new_users = $this->request->get('userslist');
            $old_users = Invitee::select('user_id')->where('imevent_id', $imevent->id)->pluck('user_id')->toArray();
            $diff_users = array_diff($old_users, $new_users);

            foreach ($new_users as $uid) {
                $user = User::findorfail($uid);
                $invitee = Invitee::where('user_id', $uid)->where('imevent_id', $imevent->id)->get();
                if ($invitee->count() == null) {
                    $invitee = Invitee::create([
                        'user_id' => $uid,
                        'imevent_id' => $imevent->id,
                    ]);
                    \Notification::send($user, new ImeventNotified($imevent, $user));
                } else {
                    $old_ids = Invitee::select('id')->whereIn('user_id', $diff_users)->where('imevent_id',
                        $imevent->id)->pluck('id')->toArray();
                    Invitee::destroy($old_ids);
                }
                if ($imevent->status == 2) {
                    foreach ($imevent->invitees as $invitee) {
                        $userslist[] = $invitee->user->id;

                        \Notification::send($user, new ImeventNotified($imevent, $user));
                    }
                }
                \Notification::send($user, new ImeventNotified($imevent, $user));
            }
        }
    }
}