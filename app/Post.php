<?php

namespace App;

use \App\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    //指定表名
//    protected $table = 'posts';

    //不可以注入数据字段
//    protected $guarded = [];

    //可以注入数据字段
//    protected $fillable = ['title', 'content'];

    use Searchable;
    //定义索引里面的type
    public function searchableAs()
    {
        return "post";
    }

    //定义哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault(function ($user) {
            $user->name = 'Guest Author';
        });
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id')->orderBy('created_at', 'desc');
    }

    //一个文章一个用户一个赞
    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    //文章所有赞
    public function zans()
    {
        return $this->hasMany('App\Zan');
    }
}
