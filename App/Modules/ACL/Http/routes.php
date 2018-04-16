<?php

Route::group(['prefix' => 'dashboard/users'], function () {
    Route::get('manage', 'ACLController@getManage')->name('users.manage');
});

Route::group(['prefix' => 'dashboard/user'], function () {
    Route::get('{id}/view', 'ACLController@getUserDetailsView')->name('user.details.view');

    Route::get('{id}/edit', 'ACLController@getUserDetailsEdit')->name('user.details.edit');

    Route::post('{id}/edit', 'ACLController@postUserDetailsEdit');

    Route::get('new', 'ACLController@getNewUser')->name('user.new');
    Route::post('new', 'ACLController@postNewUser');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('my-profile', 'ProfileController@getProfile')->name('user.profile');
});
