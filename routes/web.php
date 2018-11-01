<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*---------------------用户登陆注册模块start-----------------------*/
//用户注册页面
Route::get('/register', 'RegisterController@index');
//用户注册
Route::post('/register', 'RegisterController@register');
//用户登陆页面
Route::get('/login', 'LoginController@index');
//用户登陆
Route::post('/login', 'LoginController@login');
//注销
Route::get('/logout', 'LoginController@logout');
/*---------------------用户登陆注册模块end-----------------------*/

//Route::group(['middleware' => 'auth:web'], function(){
    /*---------------------用户个人中心模块start-----------------------*/
    //个人设置页面
    Route::get('/user/me/setting', 'UserController@setting');
    //个人设置操作
    Route::post('/user/me/setting', 'UserController@settingStore');
    //个人中心
    Route::get('/user/{user}', 'UserController@show');
    //关注用户
    Route::post('/user/{user}/fan', 'UserController@fan');
    Route::post('/user/{user}/unfan', 'UserController@unfan');
    /*---------------------用户个人中心模块end-----------------------*/


    /*---------------------文章模块start-----------------------*/
    //文章列表首页
    Route::get('/posts', 'PostController@index');
    //文章搜索页
    Route::get('/posts/search', 'PostController@search');
    //创建文章页面
    Route::get('/posts/create', 'PostController@create');
    //文章详情页
    Route::get('/posts/{post}', 'PostController@show');
    //创建文章
    Route::post('/posts', 'PostController@store');
    //编辑文章页面
    Route::get('/posts/{post}/edit', 'PostController@edit');
    //编辑文章
    Route::put('/posts/{post}', 'PostController@update');
    //删除文章
    Route::get('/posts/{post}/delete', 'PostController@delete');
    //富文本上传图片
    Route::post('/posts/image/upload', 'PostController@imageUpload');
    /*---------------------文章模块end-----------------------*/

    /*---------------------文章评论模块start-----------------------*/
    Route::post('/posts/{post}/comment', 'PostController@comment');
    /*---------------------文章评论模块end-----------------------*/

    /*---------------------文章赞模块start-----------------------*/
    Route::get('/posts/{post}/zan', 'PostController@zan');
    Route::get('/posts/{post}/unzan', 'PostController@unzan');
    /*---------------------文章赞模块end-----------------------*/

    /*---------------------专题详情页start-----------------------*/
    Route::get('/topic/{topic}', 'TopicController@show');
    /*---------------------专题详情页end-----------------------*/


//});

