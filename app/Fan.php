<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //粉丝用户信息
    public function fuser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    //被关注用户信息
    public function Suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
}
