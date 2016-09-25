<?php

Menu::group(trans('students::student.menu_students'), 'fa-users', function($parent){

	Menu::create('students.list', trans('students::student.menu_students_list'))
					->setParent($parent)->setPermission('list_students');
					
	Menu::create('student.new', trans('students::student.menu_student_new'))
					->setParent($parent)->setPermission('create_student');
					

	Menu::group(function($parent){

		Menu::create('guardians.list', trans('students::guardian.menu_guardians'))
						->setParent($parent)->setPermission('list_guardians');
						
	})->setParent($parent);

	Menu::group(function($parent){

		Menu::create('student_categories.list', trans('students::student_category.menu_categories'))
						->setParent($parent)->setPermission('list_student_categories');
						
	})->setParent($parent);
	
})->setOrder(2);
