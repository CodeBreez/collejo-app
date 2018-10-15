<?php

Route::group(['prefix' => 'dashboard/students', 'middleware' => 'auth'], function () {

    Route::get('/list', 'StudentController@getStudentList')->name('students.list');
});

Route::group(['prefix' => 'dashboard/student', 'middleware' => 'auth'], function() {

    Route::get('/new', 'StudentController@getStudentNew')->name('student.new');
    Route::post('/new', 'StudentController@postStudentNew');

    Route::get('/{id}/details/view', 'StudentController@getStudentDetailView')->name('student.details.view');

    Route::get('/{id}/details/edit', 'StudentController@getStudentDetailEdit')->name('student.details.edit');
    Route::post('/{id}/details/edit', 'StudentController@postStudentDetailEdit');
});

Route::group(['prefix' => 'dashboard/student_categories', 'middleware' => 'auth'], function() {

    Route::get('/list', 'StudentCategoryController@getStudentCategoriesList')->name('student_categories.list');
});

Route::group(['prefix' => 'dashboard/student_category', 'middleware' => 'auth'], function() {

    Route::get('/new', 'StudentCategoryController@getStudentCategoryNew')->name('student_category.new');
    Route::post('/new', 'StudentCategoryController@postStudentCategoryNew');

    Route::get('/{id}/edit', 'StudentCategoryController@getStudentCategoryEdit')->name('student_category.edit');
    Route::post('/{id}/edit', 'StudentCategoryController@postStudentCategoryEdit');
});

Route::group(['prefix' => 'dashboard/guardians', 'middleware' => 'auth'], function() {

    Route::get('/search', 'StudentCategoryController@getStudentCategoryNew')->middleware('ajax')->name('guardians.search');

    Route::get('/list', 'StudentCategoryController@getStudentCategoryNew')->name('guardians.list');
});