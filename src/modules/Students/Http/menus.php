<?php

Menu::group('Students', 'fa-users', function($parent){

	Menu::create('students.list', trans('common.list'))->setParent($parent)->setPermission('view_student');
	Menu::create('student.new', trans('common.create'))->setParent($parent)->setPermission('edit_student');
	
})->setOrder(2);
