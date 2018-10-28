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

    //软删除创表加上$table->softDeletes();
    //protected $dates = ['deleted_at'];

    //全局作用域
    /*protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AgeScope);
    }*/
    //匿名全局作用域
    /*protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function(Builder $builder) {
            $builder->where('age', '>', 200);
        });
    }*/
    //本地作用域（方法前面加上scope）
    /*public function scopePopular($query)
    {
        return $query->where('votes', '>', 100);
    }*/
    //使用方法$users = App\User::popular()->orderBy('created_at')->get();
    //动态作用域
    /*public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }*/
    //使用方法$users = App\User::ofType('admin')->get();

    //关联关系
    //主表
    /**
     * 获取关联到用户的手机
     * @param foreign_key 从表外键
     * @param local_key  父表主键
     */
    /*public function phone()
    {
        return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
    }*///一对多用hasMany()
    //从表
    /**
     * 获取拥有该手机的用户
     * @param foreign_key 从表外键
     * @param other_key   父表主键
     */
    /*public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'other_key')->withDefault(function ($user) {
            $user->name = 'Guest Author';
        });
    }*/
    //多对多
//    belongsToMany()
}
