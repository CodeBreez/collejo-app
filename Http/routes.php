<?php

Route::any('/', function(){
    return Redirect::to('auth/login');
});
/*
Route::group(['prefix' => 'setup'], function() {
	Route::any('/', 'Setup\SetupController@getIndex')->name('setup');
	Route::get('db', 'Setup\SetupController@getDbConfig')->name('setup.db');
	Route::post('db', 'Setup\SetupController@postDbConfig');
	Route::get('pre-check', 'Setup\SetupController@getPreCheck')->name('setup.precheck');
	Route::get('admin', 'Setup\SetupController@getAdmin')->name('setup.admin');
	Route::post('admin', 'Setup\SetupController@postAdmin');
	Route::get('run/{step?}/{param1?}/{param2?}', 'Setup\SetupController@getRunStep')->name('setup.run');
	Route::get('done', 'Setup\SetupController@getDone')->name('setup.done');
});
*/
Route::group(['prefix' => 'dash', 'middleware' => 'auth'], function() {
	Route::get('/', 'DashController@getIndex')->name('dash');
});
