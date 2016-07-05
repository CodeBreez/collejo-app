<?php

Route::group(['prefix' => 'dash/class', 'middleware' => 'auth'], function() {
	Route::get('/list', 'ClassController@getList')->name('classes.class.list');
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
});