<?php

Route::group(['prefix' => 'dash/students', 'middleware' => 'auth'], function() {

	Route::get('/list', 'StudentController@getStudentList')->name('students.list');

});

Route::group(['prefix' => 'dash/student', 'middleware' => 'auth'], function() {

	Route::get('/new', 'StudentController@getStudentNew')->name('student.new');
	Route::post('/new', 'StudentController@postStudentNew');

	Route::get('/{id}/details/view', 'StudentController@getStudentDetailView')->name('student.details.view');

	Route::get('/{id}/details/edit', 'StudentController@getStudentDetailEdit')->name('student.details.edit');
	Route::post('/{id}/details/edit', 'StudentController@postStudentDetailEdit');
	
	Route::get('/{id}/guardians/view', 'StudentController@getStudentGuardiansView')->name('student.guardians.view');
	Route::get('/{id}/guardians/edit', 'StudentController@getStudentGuardiansEdit')->name('student.guardians.edit');
	Route::post('/{id}/guardians/edit', 'StudentController@postStudentGuardiansEdit');
	
	Route::get('/{id}/account/view', 'StudentController@getStudentAccountView')->name('student.account.view')->middleware('reauth');

	Route::get('/{id}/account/edit', 'StudentController@getStudentAccountEdit')->name('student.account.edit')->middleware('reauth');
	Route::post('/{id}/account/edit', 'StudentController@postStudentAccountEdit')->middleware('reauth');

	Route::get('/{id}/assign_class', 'StudentController@getStudentClassAssign')->name('student.assign_class');
	Route::post('/{id}/assign_class', 'StudentController@postStudentClassAssign');

	Route::get('/{id}/assign_guardian', 'StudentController@getStudentGuardianAssign')->name('student.assign_guardian');
	Route::post('/{id}/assign_guardian', 'StudentController@postStudentGuardianAssign');

	Route::get('/{id}/remove_guardian/{gid}', 'StudentController@getStudentGuardianRemove')->name('student.remove_guardian');

});

Route::group(['prefix' => 'dash/student_categories', 'middleware' => 'auth'], function() {

	Route::get('/list', 'StudentCategoryController@getStudentCategoriesList')->name('student_categories.list');
});

Route::group(['prefix' => 'dash/student_category', 'middleware' => 'auth'], function() {

	Route::get('/new', 'StudentCategoryController@getStudentCategoryNew')->name('student_category.new');
	Route::post('/new', 'StudentCategoryController@postStudentCategoryNew');

	Route::get('/{id}/edit', 'StudentCategoryController@getStudentCategoryEdit')->name('student_category.edit');
	Route::post('/{id}/edit', 'StudentCategoryController@postStudentCategoryEdit');
});


Route::group(['prefix' => 'dash/guardians', 'middleware' => 'auth'], function() {

	Route::get('/search', 'GuardianController@getGuardiansSearch')->middleware('ajax')->name('guardians.search');

	Route::get('/list', 'GuardianController@getGuardiansList')->name('guardians.list');
});

Route::group(['prefix' => 'dash/guardian', 'middleware' => 'auth'], function() {

	Route::get('/new', 'GuardianController@getGuardianNew')->name('guardian.new');
	Route::post('/new', 'GuardianController@postGuardianNew');
	
	Route::get('/{id}/details/view', 'GuardianController@getGuardianDetailView')->name('guardian.details.view');

	Route::get('/{id}/details/edit', 'GuardianController@getGuardianDetailEdit')->name('guardian.details.edit');
	Route::post('/{id}/details/edit', 'GuardianController@postGuardianDetailEdit');

	Route::get('/{id}/contacts/view', 'GuardianController@getGuardianAddressesView')->name('guardian.addresses.view');
	Route::get('/{id}/contacts/edit', 'GuardianController@getGuardianAddressesEdit')->name('guardian.addresses.edit');

	Route::get('/{id}/contact/new', 'GuardianController@getGuardianAddressNew')->name('guardian.address.new');
	Route::post('/{id}/contact/new', 'GuardianController@postGuardianAddressNew');

	Route::get('/{id}/contact/{cid}/edit', 'GuardianController@getGuardianAddressEdit')->name('guardian.address.edit');
	Route::post('/{id}/contact/{cid}/edit', 'GuardianController@postGuardianAddressEdit');

	Route::get('/{id}/contact/{cid}/delete', 'GuardianController@getGuardianAddressDelete')->name('guardian.address.delete');

	Route::get('/{id}/account/view', 'GuardianController@getGuardianAccountView')->name('guardian.account.view')->middleware('reauth');

	Route::get('/{id}/account/edit', 'GuardianController@getGuardianAccountEdit')->name('guardian.account.edit')->middleware('reauth');
	Route::post('/{id}/account/edit', 'GuardianController@postGuardianAccountEdit')->middleware('reauth');	
});
