<?php

namespace App;

use \App\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

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

    //属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class, 'post_id', 'id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function($q) use($topic_id) {
            $q->where('topic_id', $topic_id);
        });
    }

    //全局已删除不返回
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function(Builder $builder) {
            $builder->whereIn('status', [0,1]);
        });
    }
}
