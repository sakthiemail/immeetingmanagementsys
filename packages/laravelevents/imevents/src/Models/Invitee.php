<?php

namespace Laravelevents\ImEvents\Models;

use Laravelevents\ImEvents\Models\User;
use Laravelevents\ImEvents\Models\ImEvents;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Invitee extends Eloquent
{
    protected $table='invitees';
    protected $fillable = ['user_id','imevent_id'];

    public function user()
    {
        return $this->belongsTo('Laravelevents\ImEvents\Models\User');
    }
}
