<?php

Menu::group('Classes', 'fa-graduation-cap', function($parent){

	Menu::create('grades.list', trans('classes::grade.grades'))->setParent($parent)->setPermission('view_batch');
	Menu::create('batches.list', trans('classes::batch.batches'))->setParent($parent)->setPermission('view_batch');
	
})->setOrder(1);
