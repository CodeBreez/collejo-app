<?php

Route::group(['prefix' => 'dashboard/users'], function () {

    Route::get('manage', 'ACLController@getManage')->name('users.manage');
});
