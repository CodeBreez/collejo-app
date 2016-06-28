<?php

Route::group(['prefix' => 'dash/students', 'middleware' => 'auth'], function() {
	Route::get('/list', 'StudentController@getList')->name('students.list');
	Route::get('/new', 'StudentController@getNew')->name('students.new');
	Route::post('/new', 'StudentController@postNew');
	Route::get('/{id}/details/edit', 'StudentController@getStudentDetails')->name('students.edit.detail');
	Route::post('/{id}/details/edit', 'StudentController@postStudentDetails');
	Route::get('/{id}/contacts/edit', 'StudentController@getStudentAddresses')->name('students.edit.address');
	Route::get('/{id}/contacts/edit/new', 'StudentController@getStudentAddressNew')->name('students.edit.address.new');
	Route::post('/{id}/contacts/edit/new', 'StudentController@postStudentAddressNew');
	Route::get('/{id}/contacts/edit/{cid}/edit', 'StudentController@getStudentAddressEdit')->name('students.edit.address.edit');
	Route::post('/{id}/contacts/edit/{cid}/edit', 'StudentController@postStudentAddressEdit');
	Route::get('/{id}/contacts/edit/{cid}/delete', 'StudentController@getStudentAddressDelete')->name('students.edit.address.delete');
	Route::get('/{id}/account/edit', 'StudentController@getStudentAccount')->name('students.edit.account');
	Route::post('/{id}/account/edit', 'StudentController@postStudentAccount');
});
