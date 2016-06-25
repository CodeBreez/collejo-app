<?php

Route::group(['prefix' => 'dash/students', 'middleware' => 'auth'], function() {
	Route::get('/list', 'StudentController@getList')->name('students.list');
	Route::get('/new', 'StudentController@getNew')->name('students.new');
	Route::post('/new', 'StudentController@postNew');
	Route::get('/{id}/details/edit', 'StudentController@getStudentDetails')->name('students.edit.details');
	Route::post('/{id}/details/edit', 'StudentController@postStudentDetails');
	Route::get('/{id}/contacts/edit', 'StudentController@getStudentContacts')->name('students.edit.contacts');
	Route::get('/{id}/contacts/edit/new', 'StudentController@getStudentContactsNew')->name('students.edit.contacts.new');
	Route::post('/{id}/contacts/edit/new', 'StudentController@postStudentContactsNew');
	Route::get('/{id}/account/edit', 'StudentController@getStudentAccount')->name('students.edit.account');
});
