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
//Route::any('/wechat', 'Wechat\WechatController@server');
Route::group(['namespace' => 'Wechat' , 'prefix' => 'wechat'],function(){
    Route::any( 'getWxUserInfo', 'WechatController@getWxUserInfo');
    Route::resource('user', 'UserController');
});

