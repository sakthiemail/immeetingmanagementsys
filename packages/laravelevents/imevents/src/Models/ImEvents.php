<?php

namespace Laravelevents\ImEvents\Models;

use Laravelevents\ImEvents\Models\Remainder as Remainder;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\User;
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
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo('Laravelevents\ImEvents\Models\User');
    }

    public function remainder()
    {
        return $this->belongsTo('Laravelevents\ImEvents\Models\Remainder','id','imevent_id');
    }

    public function invitees()
    {
        return $this->hasMany(
            'Laravelevents\ImEvents\Models\Invitee','imevent_id','id'
        );
    }

    public function remainders()
    {
        return $this->hasMany(
            'Laravelevents\ImEvents\Models\Remainder','imevent_id','id'
        );
    }

    public function invitee($uid)
    {
        return Invitee::where('user_id',$uid)->where('imevent_id',$this->id)->get();
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

    public function getStartDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('F d, Y, g:i a');
    }

    public function getEndDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('F d, Y, g:i a');
    }
}
