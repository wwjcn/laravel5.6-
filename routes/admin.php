<?php

Route::group(['prefix' => 'admin'], function(){
    //登陆
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');
    /*Route::get('/test', function (){
       return 'this is test';
    });*/
    Route::group(['middleware' => 'auth:admin'], function() {
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
    });
});