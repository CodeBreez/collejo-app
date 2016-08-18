<?php

Route::group(['prefix' => 'media'], function() {
	Route::post('upload', 'MediaController@postUpload')->name('media.upload');
	Route::get('{bucket}/{iid}', 'MediaController@getMedia')->name('media.get');
});

