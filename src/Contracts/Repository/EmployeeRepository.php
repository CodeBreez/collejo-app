<?php

namespace Collejo\App\Contracts\Repository;

interface EmployeeRepository
{

	public function updateEmployeePosition(array $attributes, $employeePositionId);

	public function createEmployeePosition(array $attributes);

	public function findEmployeePosition($employeePositionId);

	public function getEmployeePositions();

	public function updateEmployeeGrade(array $attributes, $employeeGradeId);

	public function createEmployeeGrade(array $attributes);

	public function findEmployeeGrade($employeeGradeId);

	public function getEmployeeGrades();

	public function updateEmployeeDepartment(array $attributes, $employeeDepartmentId);

	public function createEmployeeDepartment(array $attributes);

	public function findEmployeeDepartment($employeeDepartmentId);

	public function getEmployeeDepartments();

	public function updateEmployeeCategory(array $attributes, $employeeCategoryId);

	public function createEmployeeCategory(array $attributes);

	public function findEmployeeCategory($employeeCategoryId);

	public function getEmployeeCategories();

	public function getEmployees($criteria);

	public function updateEmployee(array $attributes, $employeeId);

	public function createEmployee(array $attributes);

	public function boot();

}