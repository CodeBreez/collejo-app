<?php

Route::group(['prefix' => 'media', 'middleware' => 'auth'], function() {

	Route::post('upload', 'MediaController@postUpload')->name('media.upload');
	Route::get('{bucket}/{iid}', 'MediaController@getMedia')->name('media.get');

    Route::post('upload', 'MediaController@postUpload')->name('media.manage');
});

