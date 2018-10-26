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

/*---------------------用户模块start-----------------------*/
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
//个人设置页面
Route::get('/user/me/setting', 'UserController@setting');
//个人设置操作
Route::Post('/user/me/setting', 'UserController@settingStore');
/*---------------------用户模块end-----------------------*/


/*---------------------文章模块start-----------------------*/
//文章列表首页
Route::get('/posts', 'PostController@index');
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
