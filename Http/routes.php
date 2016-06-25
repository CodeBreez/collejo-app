<?php

Route::any('/', function(){
    return Redirect::to('auth/login');
});

Route::group(['prefix' => 'dash', 'middleware' => 'auth'], function() {
	Route::get('/', 'DashController@getIndex')->name('dash');
});
