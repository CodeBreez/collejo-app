<?php

Menu::group(trans('classes::class.menu_classes'), 'fa-graduation-cap', function($parent){

	Menu::create('batches.list', trans('classes::batch.menu_batches'))->setParent($parent)->setPermission('list_batches');
	
	Menu::create('grades.list', trans('classes::grade.menu_grades'))->setParent($parent)->setPermission('list_grades');
	
})->setOrder(1);
