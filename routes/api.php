<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 *
 * Encryption keys generated successfully.
 * Personal access client created successfully.
 * Client ID: 1
 * Client Secret: kHolVK37RrSGxkyiQW0VL7cyREOj1T6tZoturKHj
 * Password grant client created successfully.
 * Client ID: 2
 * Client Secret: 6GmUKet2aDG0bBX8gsHTkmifnnrXXEf2uLYhTePk
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');

    Route::group(['middleware' => 'refresh.token'] , function($router){
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        Route::post('register' , 'AuthController@register');
    });
});
