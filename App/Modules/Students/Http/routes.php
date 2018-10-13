<?php

Route::group(['prefix' => 'dashboard/students', 'middleware' => 'auth'], function () {
    Route::get('/list', 'StudentController@getStudentList')->name('students.list');
});
