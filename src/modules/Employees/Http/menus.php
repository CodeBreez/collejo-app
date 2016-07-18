<?php

Menu::group('Employees', 'fa-briefcase', function($parent){

	Menu::create('employees.list', 'List')->setParent($parent)->setPermission('view_employee');
	Menu::create('employee.new', 'Create New')->setParent($parent)->setPermission('edit_employee');
	
})->setOrder(3);
