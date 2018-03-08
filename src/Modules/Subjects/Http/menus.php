<?php

Menu::group(trans('subjects::subject.menu_subjects'), 'fa-book', function ($parent) {
    Menu::create('subjects.list', trans('subjects::subject.list'))->setParent($parent)->setPermission('list_batches');

    Menu::group(function ($parent) {
        Menu::create('subject.new', trans('subjects::subject.new'))->setParent($parent)->setPermission('create_subject');
    })->setParent($parent);
})->setOrder(2);
