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


Route::post('room', 'RoomController@create');
Route::group(['prefix' => 'rooms'], function(){
    Route::get('', 'RoomController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'RoomController@single');
        Route::put('', 'RoomController@update');

        Route::delete('', 'RoomController@delete');

        Route::post('desk', 'RoomController@createDesk');

        Route::group(["prefix" => "desks"], function(){
            Route::get('', 'RoomController@desks');
        });
    });
});

Route::group(['prefix' => 'desks'], function(){
    Route::get('', 'DeskController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'DeskController@single');
        Route::put('', 'DeskController@update');

        Route::delete('', 'DeskController@delete');

        Route::post('group', 'DeskController@createGroup');

        Route::get('groups', 'DeskController@groups');
        Route::get('users', 'DeskController@users');
    });
});


Route::group(['prefix' => 'groups'], function(){
    Route::get('', 'GroupController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'GroupController@single');
        Route::put('', 'GroupController@update');

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
    });
});

Route::group(['prefix' => 'lamps'], function(){
    Route::get('', 'LampController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'LampController@single');
        Route::put('', 'LampController@update');
        Route::get('group', 'LampController@getGroup');

        Route::get('priority', 'LampController@ownership');
        Route::post('priority', 'LampController@setOwnership');

    });
});

Route::post('user', 'UserController@create');
Route::group(['prefix' => 'users'], function(){
    Route::get('', 'UserController@retrieve');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', 'UserController@single');
        Route::put('', 'UserController@update');

        Route::delete('', 'UserController@delete');
    });
});

Route::group(['prefix' => "priorities"], function(){
    Route::get('{lamp}', 'PriorityController@ownership');
});

Route::group(['prefix' => 'stats'], function (){

});


Route::group(['prefix' => 'observe'], function(){
    Route::post("light/{endpoint}", 'ObserveController@lightUpdate');
    Route::post("sensor/{endpoint}", 'ObserveController@sensorUpdate');
});

