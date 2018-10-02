<?php

Route::group(['prefix' => 'assets'], function () {

    Route::get('fe-assets.js', 'AssetsController@getFrontAssets')->name('fe-assets.js');
});
