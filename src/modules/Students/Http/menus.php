<?php

Menu::group(trans('students::student.menu_students'), 'fa-users', function($parent){

	Menu::create('students.list', trans('students::student.menu_students_list'))->setParent($parent)->setPermission('view_student');
	Menu::create('student.new', trans('students::student.menu_student_new'))->setParent($parent)->setPermission('edit_student');

	Menu::create('student_categories.list', trans('students::student_category.menu_categories'))->setParent($parent)->setPermission('edit_student');
	
})->setOrder(2);
