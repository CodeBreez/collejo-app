<?php

Menu::group(trans('students::menu.students'), 'fa-users', function ($parent) {

    Menu::create('students.list', trans('students::menu.students'))->setParent($parent)->setPermission('list_students')->setPath('students.list');

    Menu::create('student.new', trans('students::menu.student_new'))
        ->setParent($parent)->setPermission('create_student');

    Menu::group(function($parent){

        Menu::create('guardians.list', trans('students::menu.guardians'))
            ->setParent($parent)->setPermission('list_guardians');

    })->setParent($parent);

    Menu::group(function($parent){

        Menu::create('student_categories.list', trans('students::menu.student_categories'))
            ->setParent($parent)->setPermission('list_student_categories');

    })->setParent($parent);

})->setOrder(5);
