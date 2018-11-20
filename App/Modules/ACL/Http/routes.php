<?php

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'reauth']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('manage', 'ACLController@getManage')->name('users.manage');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('{id}/view', 'ACLController@getUserDetailsView')->name('user.details.view');

        Route::get('{id}/edit', 'ACLController@getUserDetailsEdit')->name('user.details.edit');

        Route::post('{id}/edit', 'ACLController@postUserDetailsEdit');

        Route::get('{id}/roles/view', 'ACLController@getUserRolesView')->name('user.roles.view');

        Route::get('{id}/roles/edit', 'ACLController@getUserRolesEdit')->name('user.roles.edit');

        Route::post('{id}/roles/edit', 'ACLController@postUserRolesEdit');

        Route::get('new', 'ACLController@getNewUser')->name('user.new');
        Route::post('new', 'ACLController@postNewUser');
    });
});
