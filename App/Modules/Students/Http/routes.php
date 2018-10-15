<?php

Route::group(['prefix' => 'dashboard/students', 'middleware' => 'auth'], function () {
    Route::get('/list', 'StudentController@getStudentList')->name('students.list');
});

Route::group(['prefix' => 'dash/student', 'middleware' => 'auth'], function () {
    Route::get('/new', 'StudentController@getStudentNew')->name('student.new');
    Route::post('/new', 'StudentController@postStudentNew');

    Route::get('/{id}/details/view', 'StudentController@getStudentDetailView')->name('student.details.view');

    Route::get('/{id}/details/edit', 'StudentController@getStudentDetailEdit')->name('student.details.edit');
    Route::post('/{id}/details/edit', 'StudentController@postStudentDetailEdit');
});
