<?php

namespace Laravelevents\ImEvents\Models;
use Laravelevents\ImEvents\Models\Invitee;
use App\User as CoreUser;

class User extends CoreUser
{
    protected $table='users';

    public function invitees()
    {
        return $this->hasMany('Laravelevents\ImEvents\Models\Invitee',);
    }
}
