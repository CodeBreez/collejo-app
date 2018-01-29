<?php

Menus::group(trans('classes::menu.classes'), 'fa-graduation-cap', function($parent){

	Menus::create('batches.list', trans('classes::menu.batches'))->setParent($parent)->setPermission('list_batches')->setPath('batches.list');

	Menus::create('grades.list', trans('classes::menu.grades'))->setParent($parent)->setPermission('list_grades')->setPath('grades.list');

})->setOrder(1);
