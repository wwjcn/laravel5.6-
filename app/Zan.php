<?php

namespace App;

use \App\Model;

class Zan extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
