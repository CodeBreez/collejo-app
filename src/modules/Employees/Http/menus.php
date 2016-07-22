<?php

Menu::group('Employees', 'fa-briefcase', function($parent){

	Menu::create('employees.list', trans('common.list'))->setParent($parent)->setPermission('view_employee');
	Menu::create('employee.new', trans('common.create'))->setParent($parent)->setPermission('edit_employee');
	
})->setOrder(3);
