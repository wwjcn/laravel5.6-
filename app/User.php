<?php

namespace App;

use \App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户的文章列表
    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    //粉丝列表
    public function fans()
    {
        return $this->hasMany('App\Fan', 'star_id', 'id');
    }

    //我关注的
    public function stars()
    {
        return $this->hasMany('App\Fan', 'fan_id', 'id');
    }

    //关注
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    //关注
    public function doUnfan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    //当前用户是否被uid关注
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    //当前用户是否关注uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }

    //用户收到通知
    public function notices()
    {
        return $this->belongsToMany(\App\Notice::class, 'user_notice', 'user_id', 'notice_id')->withPivot(['user_id', 'notice_id']);
    }

    //给用户增加通知
    public function addNotice($notice)
    {
        return $this->notices()->save($notice);//detch删除
    }
}
