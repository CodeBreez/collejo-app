<?php

Route::group(['prefix' => 'dash/employees', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeController@getEmployeeList')->name('employees.list');
});

Route::group(['prefix' => 'dash/employee', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeeController@getEmployeeNew')->name('employee.new');
	Route::post('/new', 'EmployeeController@postEmployeeNew');

	Route::get('/{id}/edit', 'EmployeeController@getEmployeeDetailsEdit')->name('employee.details.edit');
	Route::post('/{id}/edit', 'EmployeeController@postEmployeeDetailsEdit');
});

Route::group(['prefix' => 'dash/employee_categories', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeCategoryController@getEmployeeCategoryList')->name('employees_categories.list');
});

Route::group(['prefix' => 'dash/employee_category', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeeCategoryController@getEmployeeCategoryNew')->name('employee_category.new');
	Route::post('/new', 'EmployeeCategoryController@postEmployeeCategoryNew');

	Route::get('/{id}/edit', 'EmployeeCategoryController@getEmployeeCategoryEdit')->name('employee_category.edit');
	Route::post('/{id}/edit', 'EmployeeCategoryController@postEmployeeCategoryEdit');
});

Route::group(['prefix' => 'dash/employee_departments', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeDepartmentController@getEmployeeDepartmentList')->name('employees_departments.list');
});

Route::group(['prefix' => 'dash/employee_department', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeeDepartmentController@getEmployeeDepartmentNew')->name('employee_department.new');
	Route::post('/new', 'EmployeeDepartmentController@postEmployeeDepartmentNew');

	Route::get('/{id}/edit', 'EmployeeDepartmentController@getEmployeeDepartmentEdit')->name('employee_department.edit');
	Route::post('/{id}/edit', 'EmployeeDepartmentController@postEmployeeDepartmentEdit');
});

Route::group(['prefix' => 'dash/employee_grades', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeGradeController@getEmployeeGradeList')->name('employees_grades.list');
});

Route::group(['prefix' => 'dash/employee_grade', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeeGradeController@getEmployeeGradeNew')->name('employee_grade.new');
	Route::post('/new', 'EmployeeGradeController@postEmployeeGradeNew');

	Route::get('/{id}/edit', 'EmployeeGradeController@getEmployeeGradeEdit')->name('employee_grade.edit');
	Route::post('/{id}/edit', 'EmployeeGradeController@postEmployeeGradeEdit');
});

Route::group(['prefix' => 'dash/employee_positions', 'middleware' => 'auth'], function() {

	Route::get('/list', 'EmployeeGradeController@getEmployeePositionList')->name('employees_positions.list');
});

Route::group(['prefix' => 'dash/employee_position', 'middleware' => 'auth'], function() {

	Route::get('/new', 'EmployeePositionController@getEmployeeGradeNew')->name('employee_position.new');
	Route::post('/new', 'EmployeePositionController@postEmployeeGradeNew');

	Route::get('/{id}/edit', 'EmployeePositionController@getEmployeeGradeEdit')->name('employee_position.edit');
	Route::post('/{id}/edit', 'EmployeePositionController@postEmployeeGradeEdit');
});
