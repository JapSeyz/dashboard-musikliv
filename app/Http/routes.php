<?php

Route::group(['middleware' => 'auth.very_basic'], function () {
    Route::get('/', 'DashboardController@index');
    Route::post('/pusher/authenticate', 'PusherController@authenticate');
    
    Route::get('admin', 'AdminController@index');
    Route::post('admin', 'AdminController@store');
});