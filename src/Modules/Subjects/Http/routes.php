<?php

Route::group(['prefix' => 'dash/subjects', 'middleware' => 'auth'], function() {

	Route::get('/list', 'SubjectController@getSubjectList')->name('subjects.list');

});

Route::group(['prefix' => 'dash/subject', 'middleware' => 'auth'], function() {

	Route::get('/new', 'SubjectController@getSubjectNew')->name('subject.new');
	Route::post('/new', 'SubjectController@postSubjectNew');

});