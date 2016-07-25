<?php

Menu::group(trans('classes::class.menu_classes'), 'fa-graduation-cap', function($parent){

	Menu::create('grades.list', trans('classes::grade.menu_grades'))->setParent($parent)->setPermission('view_batch');
	Menu::create('batches.list', trans('classes::batch.menu_batches'))->setParent($parent)->setPermission('view_batch');
	
})->setOrder(1);
