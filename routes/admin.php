<?php

Route::group(['prefix' => 'admin'], function(){
    //登陆
    Route::get('/login', '\App\Admin\Controllers\LoginController@index')->name('admin.login');
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');
    /*Route::get('/test', function (){
       return 'this is test';
    });*/
    Route::group(['middleware' => 'auth:admin'], function() {
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
        //用户模块
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', '\App\Admin\Controllers\UserController@index');
            Route::get('/create', '\App\Admin\Controllers\UserController@create');
            Route::post('/store', '\App\Admin\Controllers\UserController@store');
        });
        //文章模块
        Route::group(['prefix' => 'posts'], function(){
            Route::get('/', '\App\Admin\Controllers\PostController@index');
            Route::post('/{post}/status', '\App\Admin\Controllers\PostController@status');
        });
    });
});