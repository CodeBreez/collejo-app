<?php

Route::group(['prefix' => 'dash/batches', 'middleware' => 'auth'], function() {

	Route::get('/list', 'BatchController@getBatchList')->name('batches.list');

});

Route::group(['prefix' => 'dash/batch', 'middleware' => 'auth'], function() {

	Route::get('/new', 'BatchController@getBatchNew')->name('batch.new');
	Route::post('/new', 'BatchController@postBatchNew');
	
	Route::get('/{id}/detail/edit', 'BatchController@getBatchDetailEdit')->name('batch.detail.edit');
	Route::post('/{id}/detail/edit', 'BatchController@postBatchDetailEdit');

	Route::get('/{id}/terms/view', 'BatchController@getBatchTerms')->name('batch.terms.view');

	Route::get('/{id}/term/new', 'BatchController@getBatchTermNew')->name('batch.term.new');
	Route::post('/{id}/term/new', 'BatchController@postBatchTermNew');

	Route::get('/{id}/term/{tid}/edit', 'BatchController@getBatchTermEdit')->name('batch.term.edit');
	Route::post('/{id}/term/{tid}/edit', 'BatchController@postBatchTermEdit');

	Route::get('/{id}/term/{tid}/delete', 'BatchController@getBatchTermDelete')->name('batch.term.delete');
});

Route::group(['prefix' => 'dash/grades', 'middleware' => 'auth'], function() {
	
	Route::get('/list', 'GradeController@getGradeList')->name('grades.list');

});
	
Route::group(['prefix' => 'dash/grade', 'middleware' => 'auth'], function() {

	Route::get('/new', 'GradeController@getGradeNew')->name('grade.new');
	Route::post('/new', 'GradeController@postGradeNew');

	Route::get('/{gid}/detail/edit', 'GradeController@getGradeDetailEdit')->name('grade.detail.edit');
	Route::post('/{gid}/detail/edit', 'GradeController@postGradeDetailEdit');

	Route::get('/{gid}/delete', 'GradeController@getDelete')->name('grade.delete');
	
	Route::get('/{gid}/classes/view', 'GradeController@getGradeClassesView')->name('grade.classes.view');

	Route::get('/{id}/class/new', 'GradeController@getGradeClassNew')->name('grade.class.new');
	Route::post('/{id}/class/new', 'GradeController@postGradeClassNew');

	Route::get('/{id}/class/{tid}/edit', 'GradeController@getGradeClassEdit')->name('grade.class.edit');
	Route::post('/{id}/class/{tid}/edit', 'GradeController@postGradeClassEdit');

	Route::get('/{id}/class/{tid}/delete', 'GradeController@getGradeClassDelete')->name('grade.class.delete');

});