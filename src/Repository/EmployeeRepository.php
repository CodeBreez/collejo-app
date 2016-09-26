<?php

namespace Collejo\App\Repository;

use Collejo\App\Foundation\Repository\BaseRepository;
use Collejo\App\Contracts\Repository\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\App\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Models\Employee;
use Collejo\App\Models\Address;
use Collejo\App\Models\EmployeeCategory;
use Collejo\App\Models\EmployeeDepartment;
use Collejo\App\Models\EmployeeGrade;
use Collejo\App\Models\EmployeePosition;
use Collejo\App\Contracts\Repository\UserRepository as UserRepositoryContract;
use DB;
use Carbon;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryContract {

	protected $userRepository;

	public function updateEmployeePosition(array $attributes, $employeePositionId)
	{
		$this->findEmployeePosition($employeePositionId)->update($attributes);

		return $this->findEmployeePosition($employeePositionId);
	}

	public function createEmployeePosition(array $attributes)
	{
		return EmployeePosition::create($attributes);
	}

	public function findEmployeePosition($employeePositionId)
	{
		return EmployeePosition::findOrFail($employeePositionId);
	}

	public function getEmployeePositions()
	{
		return $this->search(EmployeePosition::class);
	}

	public function updateEmployeeGrade(array $attributes, $employeeGradeId)
	{
		$this->findEmployeeGrade($employeeGradeId)->update($attributes);

		return $this->findEmployeeGrade($employeeGradeId);
	}

	public function createEmployeeGrade(array $attributes)
	{
		return EmployeeGrade::create($attributes);
	}

	public function findEmployeeGrade($employeeGradeId)
	{
		return EmployeeGrade::findOrFail($employeeGradeId);
	}

	public function getEmployeeGrades()
	{
		return $this->search(EmployeeGrade::class);
	}

	public function updateEmployeeDepartment(array $attributes, $employeeDepartmentId)
	{
		$this->findEmployeeDepartment($employeeDepartmentId)->update($attributes);

		return $this->findEmployeeDepartment($employeeDepartmentId);
	}

	public function createEmployeeDepartment(array $attributes)
	{
		return EmployeeDepartment::create($attributes);
	}

	public function findEmployeeDepartment($employeeDepartmentId)
	{
		return EmployeeDepartment::findOrFail($employeeDepartmentId);
	}

	public function getEmployeeDepartments()
	{
		return $this->search(EmployeeDepartment::class);
	}

	public function updateEmployeeCategory(array $attributes, $employeeCategoryId)
	{
		$this->findEmployeeCategory($employeeCategoryId)->update($attributes);

		return $this->findEmployeeCategory($employeeCategoryId);
	}

	public function createEmployeeCategory(array $attributes)
	{
		return EmployeeCategory::create($attributes);
	}

	public function findEmployeeCategory($employeeCategoryId)
	{
		return EmployeeCategory::findOrFail($employeeCategoryId);
	}

	public function getEmployeeCategories()
	{
		return $this->search(EmployeeCategory::class);
	}

	public function getEmployees($criteria)
	{
		return $this->search($criteria);
	}

	public function findEmployee($id)
	{
		return Employee::findOrFail($id);
	}

	public function updateEmployee(array $attributes, $employeeId)
	{
		$employee = $this->findEmployee($employeeId);

		if (isset($attributes['joined_on'])) {
			$attributes['joined_on'] = toUTC($attributes['joined_on']);
		}

		if (!isset($attributes['image_id'])) {
			$attributes['image_id'] = null;
		}

		$attributes['employee_category_id'] = $this->findEmployeePosition($attributes['employee_position_id'])->employeeCategory->id;

		$employeeAttributes = $this->parseFillable($attributes, Employee::class);

		DB::transaction(function () use ($attributes, $employeeAttributes, &$employee, $employeeId) {
			$employee->update($employeeAttributes);

			$user = $this->userRepository->update($attributes, $employee->user->id);
		});

		return $employee;
	}

	public function createEmployee(array $attributes)
	{
		$employee = null;
		
		$attributes['joined_on'] = toUTC($attributes['joined_on']);
		
		if (!isset($attributes['image_id'])) {
			$attributes['image_id'] = null;
		}

		$attributes['employee_category_id'] = $this->findEmployeePosition($attributes['employee_position_id'])->employeeCategory->id;

		$employeeAttributes = $this->parseFillable($attributes, Employee::class);

		DB::transaction(function () use ($attributes, $employeeAttributes, &$employee) {
			$user = $this->userRepository->create($attributes);

			$employee = Employee::create(array_merge($employeeAttributes, ['user_id' => $user->id]));

			$this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('employee'));
		});

		return $employee;
	}

    public function boot()
    {
    	parent::boot();

    	$this->userRepository = app()->make(UserRepositoryContract::class);
    }
}