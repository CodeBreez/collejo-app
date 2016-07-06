<?php

Route::group(['prefix' => 'dash/class', 'middleware' => 'auth'], function() {

	Route::get('/list', 'ClassController@getList')->name('classes.class.list');

	Route::get('/new', 'ClassController@getNew')->name('classes.class.new');
	Route::post('/new', 'ClassController@postNew');

	Route::get('/{cid}/detail/edit', 'ClassController@getEdit')->name('classes.class.edit.detail');
	Route::post('/{cid}/detail/edit', 'ClassController@postEdit');

	Route::get('/{cid}/delete', 'ClassController@getDelete')->name('classes.class.delete');
});

Route::group(['prefix' => 'dash/batches', 'middleware' => 'auth'], function() {

	Route::get('/list', 'BatchController@getList')->name('classes.batch.list');

	Route::get('/new', 'BatchController@getNew')->name('classes.batch.new');
	Route::post('/new', 'BatchController@postNew');

	Route::get('/{id}/detail/edit', 'BatchController@getDetails')->name('classes.batch.edit.detail');
	Route::post('/{id}/detail/edit', 'BatchController@postDetails');

	Route::get('/{id}/term/edit', 'BatchController@getTerms')->name('classes.batch.edit.term');
	Route::post('/{id}/term/edit', 'BatchController@postTerms');

	Route::get('/{id}/term/edit/new', 'BatchController@getTermNew')->name('classes.batch.edit.term.new');
	Route::post('/{id}/term/edit/new', 'BatchController@postTermNew');

	Route::get('/{id}/term/edit/{tid}/edit', 'BatchController@getTermEdit')->name('classes.batch.edit.term.edit');
	Route::post('/{id}/term/edit/{tid}/edit', 'BatchController@postTermEdit');

	Route::get('/{id}/term/edit/{tid}/delete', 'BatchController@getTermDelete')->name('classes.batch.edit.term.delete');
});

Route::group(['prefix' => 'dash/grade', 'middleware' => 'auth'], function() {
	
	Route::get('/list', 'GradeController@getList')->name('classes.grade.list');

	Route::get('/new', 'GradeController@getNew')->name('classes.grade.new');
	Route::post('/new', 'GradeController@postNew');
	
	Route::get('/{gid}/detail/edit', 'GradeController@getEdit')->name('classes.grade.edit.detail');
	Route::post('/{gid}/detail/edit', 'GradeController@postEdit');

	Route::get('/{gid}/delete', 'GradeController@getDelete')->name('classes.grade.delete');
});