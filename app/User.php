<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function identity()
    {
        return $this->belongsTo('App\User_Identity','identity_id','id');
    }

    public function status()
    {
        return $this->belongsTo('App\User_Status','status_id','id');
    }

}
