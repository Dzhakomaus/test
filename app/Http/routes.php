<?php


use Tymon\JWTAuth\Facades\JWTAuth;


Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('signup', 'AuthenticateController@signup');
    Route::post('getMes', 'HomeController@getMessages');

});

Route::group([
    'prefix' => 'api',
    'middleware' => ['jwt.auth']
], function () {
    Route::resource('home', 'HomeController@getUser');
    Route::post('setmes', 'HomeController@setMessage');
    Route::post('myMessages', 'HomeController@myMessages');
});
