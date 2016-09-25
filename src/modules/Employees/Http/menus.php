<?php

Menu::group(trans('employees::employee.menu_employees'), 'fa-briefcase', function($parent){

	Menu::create('employees.list', trans('employees::employee.menu_employee_list'))
						->setParent($parent)->setPermission('list_employees');


	Menu::create('employee.new', trans('employees::employee.menu_employee_new'))
						->setParent($parent)->setPermission('create_employee');

	Menu::group(function($parent){

		Menu::create('employee_categories.list', trans('employees::employee_category.menu_categories'))
						->setParent($parent)->setPermission('list_employee_cetegories');

		Menu::create('employee_positions.list', trans('employees::employee_position.menu_positions'))
						->setParent($parent)->setPermission('list_employee_positions');

		Menu::create('employee_grades.list', trans('employees::employee_grade.menu_grades'))
						->setParent($parent)->setPermission('list_employee_grades');

		Menu::create('employee_departments.list', trans('employees::employee_department.menu_departments'))
						->setParent($parent)->setPermission('list_employee_departments');

		
	})->setParent($parent);
	
})->setOrder(3);
