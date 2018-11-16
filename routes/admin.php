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
            //用户角色
            Route::get('/{user}/role', '\App\Admin\Controllers\UserController@role');
            Route::post('/{user}/role', '\App\Admin\Controllers\UserController@sotreRole');
        });
        //角色
        Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
        Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
        Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
        Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
        Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

        //权限
        Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
        Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
        Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');

        //文章模块
        Route::group(['prefix' => 'posts'], function(){
            Route::get('/', '\App\Admin\Controllers\PostController@index');
            Route::post('/{post}/status', '\App\Admin\Controllers\PostController@status');
        });
    });
});