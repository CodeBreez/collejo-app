<?php

Route::group(['prefix' => 'auth'], function () {

    // We've defined login twice to get pass Laravel being hard coding the login route name
    Route::get('login', 'LoginController@showLoginForm')->name('login');

    Route::post('login', 'LoginController@login');

    //Route::get('reauth', 'AuthController@getReauth')->name('auth.reauth');
    //Route::post('reauth', 'AuthController@postReauth');

    Route::get('logout', 'LoginController@logout')->name('auth.logout');
});

Route::group(['prefix' => 'password'], function () {

    Route::get('email', 'ResetPasswordController@getEmail')->name('password.email');
    Route::post('email', 'ResetPasswordController@postEmail');
});
