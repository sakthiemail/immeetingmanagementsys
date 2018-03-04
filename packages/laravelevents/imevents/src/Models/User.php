<?php

namespace Laravelevents\ImEvents\Models;
use Laravelevents\ImEvents\Models\Invitee;
use App\User as CoreUser;
use Illuminate\Notifications\Notifiable;

class User extends CoreUser
{
    use Notifiable;
    protected $table='users';
    public function invitees()
    {
        return $this->hasMany('Laravelevents\ImEvents\Models\Invitee');
    }
}
