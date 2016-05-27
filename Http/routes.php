<?php

Route::get('/', 'HomeController@index');
Route::any('setup', 'Setup\SetupController@index');
Route::get('setup/db', 'Setup\SetupController@getDbConfig');
Route::post('setup/db', 'Setup\SetupController@postDbConfig');
Route::get('setup/pre-check', 'Setup\SetupController@getPreCheck');
Route::get('setup/admin', 'Setup\SetupController@getAdmin');
Route::post('setup/admin', 'Setup\SetupController@postAdmin');
Route::get('setup/run', 'Setup\SetupController@copyMigrations');
