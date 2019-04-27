<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/list', 'EmployeeController@getEmployeeList')->name('employees.list');
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/new', 'EmployeeController@getEmployeeNew')->name('employee.new');
        Route::post('/new', 'EmployeeController@postEmployeeNew');

        Route::get('/{id}/details/view', 'EmployeeController@getEmployeeDetailsView')->name('employee.details.view');
        Route::get('/{id}/details/edit', 'EmployeeController@getEmployeeDetailsEdit')->name('employee.details.edit');
        Route::post('/{id}/details/edit', 'EmployeeController@postEmployeeDetailsEdit');

        Route::get('/{id}/contacts/view', 'EmployeeController@getEmployeeAddressesView')->name('employee.addresses.view');
        Route::get('/{id}/contacts/edit', 'EmployeeController@getEmployeeAddressesEdit')->name('employee.addresses.edit');

        Route::get('/{id}/contact/new', 'EmployeeController@getEmployeeAddressNew')->name('employee.address.new');
        Route::post('/{id}/contact/new', 'EmployeeController@postEmployeeAddressNew');

        Route::get('/{id}/contact/{cid}/edit', 'EmployeeController@getEmployeeAddressEdit')->name('employee.address.edit');
        Route::post('/{id}/contact/{cid}/edit', 'EmployeeController@postEmployeeAddressEdit');

        Route::get('/{id}/contact/{cid}/delete', 'EmployeeController@getEmployeeAddressDelete')->name('employee.address.delete');

        Route::get('/{id}/account/view', 'EmployeeController@getEmployeeAccountView')->name('employee.account.view');

        Route::get('/{id}/account/edit', 'EmployeeController@getEmployeeAccountEdit')->name('employee.account.edit');
        Route::post('/{id}/account/edit', 'EmployeeController@postEmployeeAccountEdit');
    });

    Route::group(['prefix' => 'employee_categories'], function () {
        Route::get('/list', 'EmployeeCategoryController@getEmployeeCategoryList')->name('employee_categories.list');
    });

    Route::group(['prefix' => 'employee_category'], function () {
        Route::get('/new', 'EmployeeCategoryController@getEmployeeCategoryNew')->name('employee_category.new');
        Route::post('/new', 'EmployeeCategoryController@postEmployeeCategoryNew');

        Route::get('/{id}/edit', 'EmployeeCategoryController@getEmployeeCategoryEdit')->name('employee_category.details.edit');
        Route::post('/{id}/edit', 'EmployeeCategoryController@postEmployeeCategoryEdit');
    });

    Route::group(['prefix' => 'employee_departments'], function () {
        Route::get('/list', 'EmployeeDepartmentController@getEmployeeDepartmentList')->name('employee_departments.list');
    });

    Route::group(['prefix' => 'employee_department'], function () {
        Route::get('/new', 'EmployeeDepartmentController@getEmployeeDepartmentNew')->name('employee_department.new');
        Route::post('/new', 'EmployeeDepartmentController@postEmployeeDepartmentNew');

        Route::get('/{id}/edit', 'EmployeeDepartmentController@getEmployeeDepartmentEdit')->name('employee_department.details.edit');
        Route::post('/{id}/edit', 'EmployeeDepartmentController@postEmployeeDepartmentEdit');
    });

    Route::group(['prefix' => 'employee_grades'], function () {
        Route::get('/list', 'EmployeeGradeController@getEmployeeGradeList')->name('employee_grades.list');
    });

    Route::group(['prefix' => 'employee_grade'], function () {
        Route::get('/new', 'EmployeeGradeController@getEmployeeGradeNew')->name('employee_grade.new');
        Route::post('/new', 'EmployeeGradeController@postEmployeeGradeNew');

        Route::get('/{id}/edit', 'EmployeeGradeController@getEmployeeGradeEdit')->name('employee_grade.details.edit');
        Route::post('/{id}/edit', 'EmployeeGradeController@postEmployeeGradeEdit');
    });

    Route::group(['prefix' => 'employee_positions'], function () {
        Route::get('/list', 'EmployeePositionController@getEmployeePositionList')->name('employee_positions.list');
    });

    Route::group(['prefix' => 'employee_position'], function () {
        Route::get('/new', 'EmployeePositionController@getEmployeePositionNew')->name('employee_position.new');
        Route::post('/new', 'EmployeePositionController@postEmployeePositionNew');

        Route::get('/{id}/edit', 'EmployeePositionController@getEmployeePositionEdit')->name('employee_position.details.edit');
        Route::post('/{id}/edit', 'EmployeePositionController@postEmployeePositionEdit');
    });
});
