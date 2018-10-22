<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    //指定表名
    //protected $table = 'posts';

    //不可以注入数据字段
    protected $guarded = [];

    //可以注入数据字段
    //protected $fillable = ['title', 'content'];
}
