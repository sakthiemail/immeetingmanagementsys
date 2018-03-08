<?php

namespace Laravelevents\ImEvents\Models;

use Laravelevents\ImEvents\Models\ImEvents as Imevents;
use Laravelevents\ImEvents\Models\Invitee as Invitee;
use Laravelevents\ImEvents\Models\User as User;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Remainder extends Eloquent
{
    protected $table='remainders';
    protected $fillable = ['imevent_id','interval','remainder_sent'];
}
