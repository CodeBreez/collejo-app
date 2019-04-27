<?php

namespace Collejo\App\Modules\Employees\Repositories;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\App\Modules\Employees\Models\Employee;
use Collejo\App\Modules\Employees\Models\EmployeeCategory;
use Collejo\App\Modules\Employees\Models\EmployeeDepartment;
use Collejo\App\Modules\Employees\Models\EmployeeGrade;
use Collejo\App\Modules\Employees\Models\EmployeePosition;
use Collejo\Foundation\Repository\BaseRepository;
use DB;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryContract
{
    protected $userRepository;

    /**
     * Update employee positions by the given id and attributes.
     *
     * @param array $attributes
     * @param $employeePositionId
     *
     * @return mixed
     */
    public function updateEmployeePosition(array $attributes, $employeePositionId)
    {
        $this->findEmployeePosition($employeePositionId)->update($attributes);

        return $this->findEmployeePosition($employeePositionId);
    }

    /**
     * Create employee positions by the given attributes.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeePosition(array $attributes)
    {
        return EmployeePosition::create($attributes);
    }

    /**
     * Get employee positions by the given criteria.
     *
     * @param $employeePositionId
     *
     * @return mixed
     */
    public function findEmployeePosition($employeePositionId)
    {
        return EmployeePosition::findOrFail($employeePositionId);
    }

    /**
     * Get employee positions.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getEmployeePositions()
    {
        return $this->search(EmployeePosition::class);
    }

    /**
     * Update employee grade by the given id and attributes.
     *
     * @param array $attributes
     * @param $employeeGradeId
     *
     * @return mixed
     */
    public function updateEmployeeGrade(array $attributes, $employeeGradeId)
    {
        $this->findEmployeeGrade($employeeGradeId)->update($attributes);

        return $this->findEmployeeGrade($employeeGradeId);
    }

    /**
     * Create employee grade by the given attributes.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeGrade(array $attributes)
    {
        return EmployeeGrade::create($attributes);
    }

    /**
     * Get employee grade by id.
     *
     * @param $employeeGradeId
     *
     * @return mixed
     */
    public function findEmployeeGrade($employeeGradeId)
    {
        return EmployeeGrade::findOrFail($employeeGradeId);
    }

    /**
     * Get employee grades by the given criteria.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getEmployeeGrades()
    {
        return $this->search(EmployeeGrade::class);
    }

    /**
     * Update employee department by the given id and attributes.
     *
     * @param array $attributes
     * @param $employeeDepartmentId
     *
     * @return mixed
     */
    public function updateEmployeeDepartment(array $attributes, $employeeDepartmentId)
    {
        $this->findEmployeeDepartment($employeeDepartmentId)->update($attributes);

        return $this->findEmployeeDepartment($employeeDepartmentId);
    }

    /**
     * Create an employee department by the given attributes.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeDepartment(array $attributes)
    {
        return EmployeeDepartment::create($attributes);
    }

    /**
     * Get employee by the given id.
     *
     * @param $employeeDepartmentId
     *
     * @return mixed
     */
    public function findEmployeeDepartment($employeeDepartmentId)
    {
        return EmployeeDepartment::findOrFail($employeeDepartmentId);
    }

    /**
     * Get employee departments.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getEmployeeDepartments()
    {
        return $this->search(EmployeeDepartment::class);
    }

    /**
     * Update employee category by the given id and attributes.
     *
     * @param array $attributes
     * @param $employeeCategoryId
     *
     * @return mixed
     */
    public function updateEmployeeCategory(array $attributes, $employeeCategoryId)
    {
        $this->findEmployeeCategory($employeeCategoryId)->update($attributes);

        return $this->findEmployeeCategory($employeeCategoryId);
    }

    /**
     * Create employee category.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEmployeeCategory(array $attributes)
    {
        return EmployeeCategory::create($attributes);
    }

    /**
     * Get employee category by id.
     *
     * @param $employeeCategoryId
     *
     * @return mixed
     */
    public function findEmployeeCategory($employeeCategoryId)
    {
        return EmployeeCategory::findOrFail($employeeCategoryId);
    }

    /**
     * Get employee categories by the given criteria.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getEmployeeCategories()
    {
        return $this->search(EmployeeCategory::class);
    }

    /**
     * Get employees with the given criteria.
     *
     * @param $criteria
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getEmployees($criteria)
    {
        return $this->search($criteria);
    }

    /**
     * Get employee by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findEmployee($id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Update an employee with the given id and attributes.
     *
     * @param array $attributes
     * @param $employeeId
     *
     * @return mixed
     */
    public function updateEmployee(array $attributes, $employeeId)
    {
        $employee = $this->findEmployee($employeeId);

        if (isset($attributes['joined_on'])) {
            $attributes['joined_on'] = toUTC($attributes['joined_on']);
        }

        if (!isset($attributes['image_id'])) {
            $attributes['image_id'] = null;
        }

        $employeeAttributes = $this->parseFillable($attributes, Employee::class);

        DB::transaction(function () use ($attributes, $employeeAttributes, &$employee, $employeeId) {
            $employee->update($employeeAttributes);

            $user = $this->userRepository->update($attributes, $employee->user->id);
        });

        return $employee;
    }

    /**
     * Create an employee with the given attributes.
     *
     * @param array $attributes
     *
     * @return null
     */
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

            $employee = Employee::create($employeeAttributes);

            $employee->user()->associate($user)->save();

            $this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('employee'));
        });

        return $employee;
    }

    public function boot()
    {
        parent::boot();

        $this->userRepository = app()->make(UserRepository::class);
    }
}
