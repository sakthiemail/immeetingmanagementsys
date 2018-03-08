<?php

namespace Laravelevents\ImEvents\Models;

use Laravelevents\ImEvents\Models\User;
use Laravelevents\ImEvents\Models\ImEvents;
use Illuminate\Database\Eloquent\Model as Eloquent;


class Invitee extends Eloquent
{
    protected $table='invitees';
    protected $fillable = ['user_id','imevent_id','accept_status','message'];

    public function user()
    {
        return $this->belongsTo('Laravelevents\ImEvents\Models\User');
    }

    public function getAcceptStatusAttribute($accept_status)
    {
        if($accept_status == 1){
            return "Accepted";
        }elseif($accept_status == 2){
            return "Declained";
        }
        return "No Status";
    }
}
