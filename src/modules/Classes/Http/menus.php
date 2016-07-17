<?php

Menu::group('Classes', 'fa-graduation-cap', function($parent){

	Menu::create('grades.list', 'Grades')->setParent($parent);
	Menu::create('batches.list', 'Batches')->setParent($parent);
	
})->setPermission('view_batch');
