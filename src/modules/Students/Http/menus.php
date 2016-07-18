<?php

Menu::group('Students', 'fa-users', function($parent){

	Menu::create('students.list', 'List')->setParent($parent)->setPermission('view_student');
	Menu::create('student.new', 'Create New')->setParent($parent)->setPermission('edit_student');
	
})->setOrder(2);
