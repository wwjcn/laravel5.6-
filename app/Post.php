<?php

namespace App;

use \App\Model;

class Post extends Model
{
    //指定表名
    protected $table = 'posts';

    //不可以注入数据字段
    protected $guarded = [];

    //可以注入数据字段
//    protected $fillable = ['title', 'content'];
}
