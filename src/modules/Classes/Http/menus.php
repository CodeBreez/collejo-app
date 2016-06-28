<?php

Menu::group('Classes', 'fa-graduation-cap', function($parent){

	Menu::create('classes.class.list', 'Classes')->setParent($parent);
	Menu::create('classes.grade.list', 'Grades')->setParent($parent);
	Menu::create('classes.batch.list', 'Batches')->setParent($parent);
	
});
