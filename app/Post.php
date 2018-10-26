<?php

namespace App;

use \App\Model;

class Post extends Model
{
    //指定表名
//    protected $table = 'posts';

    //不可以注入数据字段
//    protected $guarded = [];

    //可以注入数据字段
//    protected $fillable = ['title', 'content'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault(function ($user) {
            $user->name = 'Guest Author';
        });
    }
}
