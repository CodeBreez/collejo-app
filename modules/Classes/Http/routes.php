<?php

Route::group(['prefix' => 'dash/classes', 'middleware' => 'auth'], function() {
	Route::get('/list', 'ClassController@getList')->name('classes.class.list');
});

Route::group(['prefix' => 'dash/batches', 'middleware' => 'auth'], function() {
	Route::get('/list', 'BatchController@getList')->name('classes.batch.list');
	Route::get('/new', 'BatchController@getNew')->name('classes.batch.new');
	Route::post('/new', 'BatchController@postNew');
});

Route::group(['prefix' => 'dash/grades', 'middleware' => 'auth'], function() {
	Route::get('/list', 'GradeController@getList')->name('classes.grade.list');
});