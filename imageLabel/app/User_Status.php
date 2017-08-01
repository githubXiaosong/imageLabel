<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Status extends Model
{
    protected $table = 'user_status';

    public function users()
    {
        return $this->hasMany('App\User','status','id');
    }

}
