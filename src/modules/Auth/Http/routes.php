<?php

Route::group(['prefix' => 'auth'], function() {

	Route::get('login', 'AuthController@getLogin')->name('auth.login');
	Route::post('login', 'AuthController@postLogin');

	Route::get('reauth', 'AuthController@getReauth')->name('auth.reauth');
	Route::post('reauth', 'AuthController@postReauth');

	Route::get('logout', 'AuthController@logout')->name('auth.logout');

});

Route::group(['prefix' => 'password'], function() {

	Route::get('email', 'PasswordController@getEmail')->name('password.email');
	Route::post('email', 'PasswordController@postEmail');

});

Route::group(['prefix' => 'dash'], function() {

	Route::get('profile', 'ProfileController@getProfile')->name('user.profile');

});
