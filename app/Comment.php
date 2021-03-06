<?php

namespace App;

use \App\Model;

class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
