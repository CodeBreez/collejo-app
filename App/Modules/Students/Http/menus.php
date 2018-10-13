<?php

Menu::group(trans('students::menu.students'), 'fa-users', function ($parent) {
    Menu::create('students.list', trans('students::menu.students'))->setParent($parent)->setPermission('list_students')->setPath('students.list');
})->setOrder(5);
