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

        //系统管理权限
        Route::group(['middleware' => 'can:system'], function(){
            //用户模块
            Route::group(['prefix' => 'users'], function(){
                Route::get('/', '\App\Admin\Controllers\UserController@index');
                Route::get('/create', '\App\Admin\Controllers\UserController@create');
                Route::post('/store', '\App\Admin\Controllers\UserController@store');
                //用户角色
                Route::get('/{user}/role', '\App\Admin\Controllers\UserController@role');
                Route::post('/{user}/role', '\App\Admin\Controllers\UserController@storeRole');
            });

            //角色
            Route::group(['prefix' => 'roles'], function() {
                Route::get('/', '\App\Admin\Controllers\RoleController@index');
                Route::get('/create', '\App\Admin\Controllers\RoleController@create');
                Route::post('/store', '\App\Admin\Controllers\RoleController@store');
                Route::get('/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
                Route::post('/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');
            });

            //权限
            Route::group(['prefix' => 'permissions'], function() {
                Route::get('/', '\App\Admin\Controllers\PermissionController@index');
                Route::get('/create', '\App\Admin\Controllers\PermissionController@create');
                Route::post('/store', '\App\Admin\Controllers\PermissionController@store');
            });
        });

        //文章管理权限
        Route::group(['middleware' => 'can:post'], function() {
            //文章模块
            Route::group(['prefix' => 'posts'], function () {
                Route::get('/', '\App\Admin\Controllers\PostController@index');
                Route::post('/{post}/status', '\App\Admin\Controllers\PostController@status');
            });
        });

        Route::group(['middleware' => 'can:post'], function() {
            Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => ['index','create','store','destroy']]);
        });
    });
});