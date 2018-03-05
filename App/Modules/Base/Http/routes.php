<?php

Route::group(['prefix' => 'assets'], function () {
    Route::get('locale.js', 'AssetsController@getLocals')->name('locale.js');
});
