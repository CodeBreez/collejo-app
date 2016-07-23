<?php

Route::group(['prefix' => 'media'], function() {
	Route::get('upload', 'MediaController@getUploader')->name('media.upload');
});

