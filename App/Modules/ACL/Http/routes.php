<?php

Route::group(['prefix' => 'dashboard/users'], function () {
    Route::get('roles', 'ACLController@getRoles')->name('users.roles');
});
