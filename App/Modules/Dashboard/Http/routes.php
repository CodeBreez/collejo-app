<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
	Route::get('/', 'DashController@getIndex')->name('dash');
});
