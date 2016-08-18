<?php

Menu::group(trans('employees::employee.menu_employees'), 'fa-briefcase', function($parent){

	Menu::create('employees.list', trans('employees::employee.menu_employee_list'))->setParent($parent)->setPermission('view_employee');
	Menu::create('employee.new', trans('employees::employee.menu_employee_new'))->setParent($parent)->setPermission('edit_employee');

	Menu::group(function($parent){

		Menu::create('employee_categories.list', trans('employees::employee_category.menu_categories'))->setParent($parent)->setPermission('edit_employee');
		Menu::create('employee_positions.list', trans('employees::employee_position.menu_positions'))->setParent($parent)->setPermission('edit_employee');
		Menu::create('employee_grades.list', trans('employees::employee_grade.menu_grades'))->setParent($parent)->setPermission('edit_employee');
		Menu::create('employee_departments.list', trans('employees::employee_department.menu_departments'))->setParent($parent)->setPermission('edit_employee');
		
	})->setParent($parent);
	
})->setOrder(3);
