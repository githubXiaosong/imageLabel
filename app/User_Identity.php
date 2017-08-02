<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Identity extends Model
{
    protected $table = 'user_identity';

    public function users()
    {
        return $this->hasMany('App\User','identity','id');
    }

}
