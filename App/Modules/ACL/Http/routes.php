<?php

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'reauth']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('manage', 'ACLController@getUserManage')->name('users.manage');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('{id}/details/view', 'ACLController@getUserDetailsView')->name('user.details.view');

        Route::get('{id}/details/edit', 'ACLController@getUserDetailsEdit')->name('user.details.edit');

        Route::post('{id}/details/edit', 'ACLController@postUserDetailsEdit');

        Route::get('{id}/roles/view', 'ACLController@getUserRolesView')->name('user.roles.view');

        Route::get('{id}/roles/edit', 'ACLController@getUserRolesEdit')->name('user.roles.edit');

        Route::post('{id}/roles/edit', 'ACLController@postUserRolesEdit');

        Route::get('{id}/account/view', 'ACLController@getUserAccountView')->name('user.account.view');

        Route::get('{id}/account/edit', 'ACLController@getUserAccountEdit')->name('user.account.edit');

        Route::post('{id}/account/edit', 'ACLController@postUserAccountEdit');

        Route::get('new', 'ACLController@getNewUser')->name('user.new');
        Route::post('new', 'ACLController@postNewUser');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('manage', 'ACLController@getPermissionsManage')->name('permissions.manage');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('new', 'ACLController@getRoleNew')->name('role.new');

        Route::get('{id}/edit', 'ACLController@getRoleEdit')->name('role.edit');

        Route::post('{id}/edit', 'ACLController@postRoleEdit');
    });
});
