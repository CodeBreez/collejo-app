<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\Core\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Models\Employee;
use Collejo\App\Models\Address;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use DB;
use Carbon;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryContract {

	protected $userRepository;

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