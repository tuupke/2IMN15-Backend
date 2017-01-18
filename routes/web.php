<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/users', function () {
    return view('welcome');
});

Route::get('/sensors', function () {
    return view('sensor');
});

Route::get('/lights', function () {
    return view('light');
});
