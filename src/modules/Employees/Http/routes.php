<?php

Route::group(['prefix' => 'dash/employees', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeController@getEmplyeeList')->name('employees.list');

});

Route::group(['prefix' => 'dash/employee', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeeController@getEmplyeeNew')->name('employee.new');
	Route::post('/new', 'EmployeeController@postEmplyeeNew');


});
