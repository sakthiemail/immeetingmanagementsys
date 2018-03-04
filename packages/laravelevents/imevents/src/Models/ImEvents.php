<?php

namespace Laravelevents\ImEvents\Models;

use Laravelevents\ImEvents\Models\User as User;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ImEvents extends Eloquent
{
    protected $table='imevents';

    protected $fillable = [
        'user_id',
        'type',
        'subject',
        'description',
        'start_date',
        'end_date',
        'location',
        'user_id',
        'billable',
        'status',
        'reason',
        'remainder_interval',
    ];

    public function invitees()
    {
        return $this->hasMany(
            'Laravelevents\ImEvents\Models\Invitee','imevent_id','id'
        );
    }
    public function getEventstatusAttribute()
    {
      if($this->status == 1){
        return "Scheduled";
      }elseif($this->status == 2){
        return "Cancelled";
      }
      else {
          return "Expired";
      }
    }
}
