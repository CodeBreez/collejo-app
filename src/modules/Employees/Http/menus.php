<?php

Menu::group('Employees', 'fa-briefcase', function($parent){

	Menu::create('employees.list', trans('common.list'))->setParent($parent)->setPermission('view_employee');
	Menu::create('employee.new', trans('common.create'))->setParent($parent)->setPermission('edit_employee');

	Menu::create('employee_categories.list', trans('employees::employee_category.employee_categories'))->setParent($parent)->setPermission('edit_employee');
	Menu::create('employee_departments.list', trans('employees::employee_department.employee_departments'))->setParent($parent)->setPermission('edit_employee');
	Menu::create('employee_grades.list', trans('employees::employee_grade.employee_grades'))->setParent($parent)->setPermission('edit_employee');
	Menu::create('employee_positions.list', trans('employees::employee_position.employee_positions'))->setParent($parent)->setPermission('edit_employee');
	
})->setOrder(3);
