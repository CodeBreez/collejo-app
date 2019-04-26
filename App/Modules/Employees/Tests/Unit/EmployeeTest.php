<?php

namespace Collejo\App\Modules\Employees\Tests\Unit;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;
use Collejo\App\Modules\Employees\Models\Employee;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    private $employeeRepository;

    /**
     * Test Getting Employee list.
     */
    public function testGetEmployees()
    {
        factory(Employee::class, 5)->create();

        $employees = $this->employeeRepository
            ->getEmployees(app()->make(EmployeeListCriteria::class))->get();

        $this->assertCount(5, $employees);
    }

    /**
     * Test creating a Employee.
     */
    public function testEmployeeCreate()
    {
        $employee = factory(Employee::class)->make();
        $user = factory(User::class)->make();

        $inputData = array_merge($employee->toArray(), $user->toArray());

        $model = $this->employeeRepository->createEmployee($inputData);

        $this->assertArrayValuesEquals($model, $employee);
    }

    /**
     * Test updating a Employee.
     */
    public function testEmployeeUpdate()
    {
        $user = factory(User::class)->create();

        $employee = factory(Employee::class)->create();

        $employee->user()->associate($user)->save();

        $employeeNew = factory(Employee::class)->make();
        $userNew = factory(User::class)->make();

        $inputData = array_merge($employeeNew->toArray(), $userNew->toArray());

        $model = $this->employeeRepository->updateEmployee($inputData, $employee->id);

        $this->assertArrayValuesEquals($model, $employeeNew);
    }

    public function setup()
    {
        parent::setup();

        $this->employeeRepository = $this->app->make(EmployeeRepository::class);
    }
}
