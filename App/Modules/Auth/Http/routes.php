<?php

Route::group(['prefix' => 'auth'], function() {

	Route::get('login', 'LoginController@showLoginForm')->name('auth.login');
	Route::post('login', 'LoginController@login');

	//Route::get('reauth', 'AuthController@getReauth')->name('auth.reauth');
	//Route::post('reauth', 'AuthController@postReauth');

	Route::get('logout', 'LoginController@logout')->name('auth.logout');

});

Route::group(['prefix' => 'password'], function() {

	Route::get('email', 'ResetPasswordController@getEmail')->name('password.email');
	Route::post('email', 'ResetPasswordController@postEmail');

});

Route::group(['prefix' => 'dash'], function() {

	//Route::get('profile', 'ProfileController@getProfile')->name('user.profile');

});
