<?php

Route::group(['prefix' => 'dash/students', 'middleware' => 'auth'], function() {

	Route::get('/list', 'StudentController@getList')->name('students.list');

	Route::get('/new', 'StudentController@getNew')->name('students.new');
	Route::post('/new', 'StudentController@postNew');

	Route::get('/{id}/detail/edit', 'StudentController@getStudentDetails')->name('students.edit.detail');
	Route::post('/{id}/detail/edit', 'StudentController@postStudentDetails');

	Route::get('/{id}/contact/edit', 'StudentController@getStudentAddresses')->name('students.edit.address');

	Route::get('/{id}/contact/edit/new', 'StudentController@getStudentAddressNew')->name('students.edit.address.new');
	Route::post('/{id}/contact/edit/new', 'StudentController@postStudentAddressNew');

	Route::get('/{id}/contact/edit/{cid}/edit', 'StudentController@getStudentAddressEdit')->name('students.edit.address.edit');
	Route::post('/{id}/contact/edit/{cid}/edit', 'StudentController@postStudentAddressEdit');

	Route::get('/{id}/contact/edit/{cid}/delete', 'StudentController@getStudentAddressDelete')->name('students.edit.address.delete');
	
	Route::get('/{id}/account/edit', 'StudentController@getStudentAccount')->name('students.edit.account');
	Route::post('/{id}/account/edit', 'StudentController@postStudentAccount');
});
