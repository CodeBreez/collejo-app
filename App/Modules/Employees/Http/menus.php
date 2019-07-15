<?php

Menu::group(trans('employees::menu.employees'), 'fa-briefcase', function ($parent) {
    Menu::group(function ($parent) {
        Menu::create('employees.list', trans('employees::menu.employee_list'))
            ->setParent($parent)
            ->setPermission('list_employees');

        Menu::create('employee.new', trans('employees::menu.employee_new'))
            ->setParent($parent)
            ->setPermission('create_employee');
    })->setParent($parent);

    Menu::group(function ($parent) {
        Menu::create('employee_categories.list', trans('employees::menu.categories'))
                ->setParent($parent)
                ->setPermission('list_employee_categories');

        Menu::create('employee_positions.list', trans('employees::menu.positions'))
            ->setParent($parent)
            ->setPermission('list_employee_positions');

        Menu::create('employee_grades.list', trans('employees::menu.grades'))
            ->setParent($parent)
            ->setPermission('list_employee_grades');

        Menu::create('employee_departments.list', trans('employees::menu.departments'))
            ->setParent($parent)
            ->setPermission('list_employee_departments');
    })->setParent($parent);
})->setOrder(30);
