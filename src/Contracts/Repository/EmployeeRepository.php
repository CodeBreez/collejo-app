<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */

namespace Collejo\App\Contracts\Repository;

/**
 * Interface EmployeeRepository.
 */
interface EmployeeRepository
{
    /**
     * @param array $attributes
     * @param $employeePositionId
     *
     * @return mixed
     */
    public function updateEmployeePosition(array $attributes, $employeePositionId);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeePosition(array $attributes);

    /**
     * @param $employeePositionId
     *
     * @return mixed
     */
    public function findEmployeePosition($employeePositionId);

    /**
     * @return mixed
     */
    public function getEmployeePositions();

    /**
     * @param array $attributes
     * @param $employeeGradeId
     *
     * @return mixed
     */
    public function updateEmployeeGrade(array $attributes, $employeeGradeId);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeGrade(array $attributes);

    /**
     * @param $employeeGradeId
     *
     * @return mixed
     */
    public function findEmployeeGrade($employeeGradeId);

    /**
     * @return mixed
     */
    public function getEmployeeGrades();

    /**
     * @param array $attributes
     * @param $employeeDepartmentId
     *
     * @return mixed
     */
    public function updateEmployeeDepartment(array $attributes, $employeeDepartmentId);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeDepartment(array $attributes);

    /**
     * @param $employeeDepartmentId
     *
     * @return mixed
     */
    public function findEmployeeDepartment($employeeDepartmentId);

    /**
     * @return mixed
     */
    public function getEmployeeDepartments();

    /**
     * @param array $attributes
     * @param $employeeCategoryId
     *
     * @return mixed
     */
    public function updateEmployeeCategory(array $attributes, $employeeCategoryId);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeCategory(array $attributes);

    /**
     * @param $employeeCategoryId
     *
     * @return mixed
     */
    public function findEmployeeCategory($employeeCategoryId);

    /**
     * @return mixed
     */
    public function getEmployeeCategories();

    /**
     * @param $criteria
     *
     * @return mixed
     */
    public function getEmployees($criteria);

    /**
     * @param array $attributes
     * @param $employeeId
     *
     * @return mixed
     */
    public function updateEmployee(array $attributes, $employeeId);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployee(array $attributes);

    /**
     * @return mixed
     */
    public function boot();
}
