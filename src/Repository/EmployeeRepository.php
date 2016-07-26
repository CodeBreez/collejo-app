<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\Core\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Models\Employee;
use Collejo\App\Models\Address;
use Collejo\App\Models\EmployeeCategory;
use Collejo\App\Models\EmployeeDepartment;
use Collejo\App\Models\EmployeeGrade;
use Collejo\App\Models\EmployeePosition;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
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
		return EmployeePosition::all();
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
		return EmployeeGrade::all();
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
		return EmployeeDepartment::all();
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
		return EmployeeCategory::all();
	}

	public function getEmployees()
	{
		return $this;
	}

	public function update(array $attributes, $employeeId)
	{
		$employee = null;

		if (isset($attributes['joined_on'])) {
			$attributes['joined_on'] = toUTC($attributes['joined_on']);
		}

		$employeeAttributes = $this->parseFillable($attributes);

		DB::transaction(function () use ($attributes, $employeeAttributes, &$employee, $employeeId) {
			$employee = parent::update($employeeAttributes, $employeeId);

			$user = $this->userRepository->update($attributes, $employee->user->id);
		});

		return $employee;
	}

	public function create(array $attributes)
	{
		$employee = null;
		
		$attributes['joined_on'] = toUTC($attributes['joined_on']);

		$employeeAttributes = $this->parseFillable($attributes);

		DB::transaction(function () use ($attributes, $employeeAttributes, &$employee) {
			$user = $this->userRepository->create($attributes);

			$employee = parent::create(array_merge($employeeAttributes, ['user_id' => $user->id]));

			$this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('employee'));
		});


		return $employee;
	}

    function model()
    {
        return Employee::class;
    }

    public function boot()
    {
    	parent::boot();

    	$this->userRepository = app()->make(UserRepositoryContract::class);
    }
}