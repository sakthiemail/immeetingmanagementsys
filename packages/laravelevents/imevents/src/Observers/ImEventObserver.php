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

class ImEventObserver
{
    protected $request;

    use ImEventObserveUses;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function created(Imevent $imevent)
    {
        $this->createRemainder($imevent, $this->request);
        $this->createInvitees($imevent,  $this->request);
    }

    public function updated(Imevent $imevent)
    {
        if($imevent->isDirty()) {
            $this->saveRemainder($imevent, $this->request);
            $this->saveInvitees($imevent, $this->request);
            if($imevent->status == 2) {
                foreach ($imevent->invitees as $invitee) {
                    $userslist[] = $invitee->user->id;
                    $this->sendNotification ($imevent, $invitee->user);
                }
            }
        }
    }
}