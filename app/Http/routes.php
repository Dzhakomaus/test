<?php

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('signup', 'AuthenticateController@signup');
    Route::post('getMessages', 'MessageController@getMessages');
    Route::post('filterMessages', 'MessageController@filterMessages');

});

Route::group(['prefix' => 'api', 'middleware' => ['jwt.auth']], function () {
    Route::post('setMessage', 'MessageController@addNewMessage');
    Route::post('userMessage', 'MessageController@userMessage');
});
