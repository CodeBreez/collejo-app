<?php

Menu::group('Classes', 'fa-graduation-cap', function($parent){

	Menu::create('grades.list', 'Grades')->setParent($parent)->setPermission('view_batch');
	Menu::create('batches.list', 'Batches')->setParent($parent)->setPermission('view_batch');
	
})->setOrder(1);
