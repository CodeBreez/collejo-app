<?php

Route::group(['prefix' => 'acl'], function() {
	Route::get('roles', 'RoleController@getRoles')->name('roles.list');
});

