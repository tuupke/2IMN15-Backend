<?php

Route::group(['prefix' => 'rooms'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'room', 'hasNew' => true]);
    });

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', function ($id){
            return view('single', ['manager' => 'room', 'id' => $id]);
        });

        Route::get("desks", function(){
            return view('list', ['manager' => 'desk', 'hasNew' => true]);
        });
    });
});

Route::group(['prefix' => 'desks'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'desk']);
    });

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', function ($id){
            return view('single', ['manager' => 'desk', 'id' => $id]);
        });

        Route::get('groups', function ($id){
            return view('list', ['manager' => 'group', 'id' => $id, 'hasNew' => true]);
        });

        Route::get('users', function ($id){
            return view('list', ['manager' => 'user', 'id' => $id]);
        });
    });
});

Route::group(['prefix' => 'groups'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'group', 'hasNew' => true]);
    });

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', function ($id){
            return view('single', ['manager' => 'group', 'id' => $id]);
        });

        Route::get('lights', function ($id){
            return view('list', ['manager' => 'lamp', 'id' => $id]);
        });

        Route::get('sensors', function ($id){
            return view('list', ['manager' => 'sensor', 'id' => $id]);
        });
    });
});

Route::group(['prefix' => 'sensors'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'sensor']);
    });

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', function ($id){
            return view('single', ['manager' => 'sensor', 'id' => $id]);
        });

        Route::get('group', function ($id){
            return view('single', ['manager' => 'sensor', 'id' => $id]);
        });
    });
});

Route::group(['prefix' => 'lamps'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'lamp']);
    });

    Route::group(['prefix' => '{id}'], function() {
        Route::get('', function ($id){
            return view('single', ['manager' => 'lamp', 'id' => $id]);
        });

        Route::get('group', function ($id){
            return view('single', ['manager' => 'lamp', 'id' => $id]);
        });

        Route::get('priority', function ($id){
            return view('prio', ['manager' => 'priority', 'id' => $id, 'hasNew' => true]);
        });
    });
});


Route::group(['prefix' => 'users'], function(){
    Route::get('', function (){
        return view('list', ['manager' => 'user', 'hasNew' => true]);
    });

    Route::get('{id}/desk', function (){
        return view('single', ['manager' => 'desk']);
    });

    Route::get('{id}', function (){
        return view('single', ['manager' => 'user']);
    });
});

Route::group(['prefix' => "priorities"], function(){
    Route::group(['prefix' => "{lamp}"], function(){
        Route::get('', 'LampController@ownership');
    });
});
