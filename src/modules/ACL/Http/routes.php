<?php

Route::group(['prefix' => 'acl', 'middleware' => 'auth'], function() {
	Route::get('roles', 'RoleController@getRoles')->name('roles.list');
});

