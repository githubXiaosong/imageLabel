<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @package App对用户的每一次活动都采用gruop为单位
 */
class Group extends Model
{
    //


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
