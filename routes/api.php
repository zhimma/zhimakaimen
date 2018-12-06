<?php

Route::group(['namespace' => 'Api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'Auth\AuthController@login');
        Route::post('register', 'Auth\AuthController@register');
    });
    Route::group(['middleware' => ['refresh.token']], function ($router) {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('refresh', 'Auth\AuthController@refresh');
            Route::post('me', 'Auth\AuthController@me');
            Route::post('logout', 'Auth\AuthController@logout');
        });
        Route::resource('banner', 'BannerController');
        Route::resource('module', 'ModuleController');
        Route::resource('plate', 'PlateController');
    });
});
