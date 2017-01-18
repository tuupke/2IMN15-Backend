<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'rooms'], function(){
    Route::get('', 'RoomController@retrieve');
    Route::post('', 'RoomController@create');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'RoomController@single');
        Route::put('', 'RoomController@update');

        Route::delete('', 'RoomController@delete');

        Route::post('group', 'RoomController@createGroup');

        Route::group(["prefix" => "groups"], function(){
            Route::get('', 'RoomController@groups');
            Route::post('{group_id', 'RoomController@addGroup');
        });

    });
});

Route::group(['prefix' => 'groups'], function(){
    Route::get('', 'GroupController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'GroupController@single');

        Route::delete('', 'GroupController@delete');

        Route::get('lamps', 'GroupController@lamps');
        Route::post('lamp', 'GroupController@createLamp');
        Route::post('lamps/{rid}', 'GroupController@attachLamp');

        Route::get('sensors', 'GroupController@sensors');
        Route::post('sensor', 'GroupController@createSensor');
        Route::post('sensors/{rid}', 'GroupController@attachSensor');
    });
});

Route::group(['prefix' => 'sensors'], function(){
    Route::get('', 'SensorController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'SensorController@single');
        Route::put('', 'SensorController@update');
        Route::get('group', 'SensorController@getGroup');

        Route::delete('', 'SensorController@delete');
    });
});

Route::group(['prefix' => 'lamps'], function(){
    Route::get('', 'LampController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'LampController@single');
        Route::put('', 'LampController@update');
        Route::get('group', 'LampController@getGroup');

        Route::delete('', 'LampController@delete');
    });
});

Route::group(['prefix' => 'users'], function(){
    Route::get('', 'UserController@retrieve');
    Route::post('', 'UserController@create');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'UserController@single');
        Route::put('', 'UserController@update');

        Route::delete('', 'UserController@delete');
    });
});

Route::group(['prefix' => "priorities"], function(){
    Route::group(['prefix' => "{lamp}"], function(){
        Route::get('', 'LampController@ownership');
        Route::post('', 'LampController@setOwnership');
    });
});

// Below => working


Route::group(['prefix' => 'stats'], function (){

});


Route::group(['prefix' => 'observe'], function(){
    Route::post("light/{endpoint}", 'ObserveController@lightUpdate');
    Route::post("sensor/{endpoint}", 'ObserveController@sensorUpdate');
});

