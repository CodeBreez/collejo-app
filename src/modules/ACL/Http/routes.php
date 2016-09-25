<?php

Route::group(['prefix' => 'acl', 'middleware' => 'auth'], function() {

	Route::get('roles', 'RoleController@getRoles')->name('roles.list');

	Route::get('roles/{rid}/{mname}/permissions/edit', 'RoleController@getRolePermmissionsEdit')->name('role.permissions.edit');

	Route::post('roles/{rid}/{mname}/permissions/edit', 'RoleController@postRolePermmissionsEdit');

});

