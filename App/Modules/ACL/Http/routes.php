<?php

Route::group(['prefix' => 'dashboard/users'], function () {

    Route::get('manage', 'ACLController@getManage')->name('users.manage');
});

Route::group(['prefix' => 'dashboard/user'], function () {

    Route::get('{id}/view', 'ACLController@getuserDetails')->name('user.details.view');

    Route::get('new', 'ACLController@getNewUser')->name('user.new');
});
