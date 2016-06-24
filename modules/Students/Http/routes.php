<?php

Route::group(['prefix' => 'dash/students', 'middleware' => 'auth'], function() {
	Route::get('/list', 'StudentController@getList')->name('students.list');
	Route::get('/new', 'StudentController@getNew')->name('students.new');
	Route::post('/new', 'StudentController@postNew');
	Route::get('/{id}/edit/details', 'StudentController@getStudentDetails')->name('students.edit.details');
	Route::get('/{id}/edit/contacts', 'StudentController@getStudentContacts')->name('students.edit.contacts');
});
