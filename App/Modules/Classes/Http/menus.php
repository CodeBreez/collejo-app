<?php

Menu::group(trans('classes::menu.classes'), 'fa-graduation-cap', function ($parent) {
    Menu::create('batches.list', trans('classes::menu.batches'))
        ->setParent($parent)
        ->setPermission('list_batches')
        ->setPath('batches.list');

    Menu::create('grades.list', trans('classes::menu.grades'))
        ->setParent($parent)
        ->setPermission('list_grades')
        ->setPath('grades.list');
})->setOrder(10);
