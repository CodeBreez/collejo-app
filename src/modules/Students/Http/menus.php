<?php

Menu::group('Students', 'fa-users', function($parent){

	Menu::create('students.list', 'List')->setParent($parent);
	Menu::create('student.new', 'Create New')->setParent($parent);
	
});
