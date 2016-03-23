<?php


use Tymon\JWTAuth\Facades\JWTAuth;


Route::get('/', function () {
    return view('index');
});
// тут с $api пока что не разобрался 
//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', ['prefix' => 'api'], function($api) {
//    $api->post('authenticate', 'AuthenticateController@authenticate');
//    $api->post('signup', 'AuthenticateController@signup');
//});

Route::group(['prefix' => 'api'], function () {
    //Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
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

//Route::resource('api/setmes', 'HomeController@setMes');