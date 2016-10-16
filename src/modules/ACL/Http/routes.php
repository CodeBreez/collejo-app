<?php

Route::group(['prefix' => 'dash/acl', 'middleware' => 'auth'], function() {

	Route::get('roles', 'RoleController@getRoles')->name('roles.list');


	Route::group(['prefix' => 'role', 'middleware' => 'auth'], function() {

		Route::get('{rid}/{mname}/permissions/edit', 'RoleController@getRolePermmissionsEdit')->name('role.permissions.edit');

		Route::post('{rid}/{mname}/permissions/edit', 'RoleController@postRolePermmissionsEdit');

		Route::get('new', 'RoleController@getRoleNew')->name('role.new');
		Route::post('new', 'RoleController@postRoleNew');
		
	});
});

