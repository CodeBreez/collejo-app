<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\StudentRepository as StudentRepositoryContract;
use Collejo\App\Models\Student;
use Collejo\App\Models\Address;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use DB;

class StudentRepository extends BaseRepository implements StudentRepositoryContract {

	protected $userRepository;

	public function assignToClass($batchId, $classId, $studentId)
	{

	}

	public function deleteAddress($addressId, $studentId)
	{
		$this->findAddress($addressId, $studentId)->delete();
	}

	public function updateAddress(array $attributes, $addressId, $studentId)
	{
		$attributes['is_emergency'] = isset($attributes['is_emergency']);

		$this->findAddress($addressId, $studentId)->update($attributes);

		return $this->findAddress($addressId, $studentId);
	}

	public function createAddress(array $attributes, $studentId)
	{
		$address = null;

		$student = $this->find($studentId);

		$attributes['user_id'] = $student->user->id;
		$attributes['is_emergency'] = isset($attributes['is_emergency']);

		DB::transaction(function () use ($attributes, &$address) {
			$address = Address::create($attributes);
		});

		return $address;
	}

	public function findAddress($addressId, $studentId)
	{
		return Address::where(['user_id' => $this->find($studentId)->user->id, 'id' => $addressId])->firstOrFail();
	}

	public function getStudents()
	{
		return $this;
	}

	public function update(array $attributes, $studentId)
	{
		$student = null;

		if (isset($attributes['admitted_on'])) {
			$attributes['admitted_on'] = $this->userTzConvert($attributes['admitted_on']);
		}

		$studentAttributes = $this->parseFillable($attributes);

		DB::transaction(function () use ($attributes, $studentAttributes, &$student, $studentId) {
			$student = parent::update($studentAttributes, $studentId);

			$user = $this->userRepository->update($attributes, $student->user->id);
		});

		return $student;
	}

	public function create(array $attributes)
	{
		$student = null;
		
		$attributes['admitted_on'] = $this->userTzConvert($attributes['admitted_on']);

		$studentAttributes = $this->parseFillable($attributes);

		DB::transaction(function () use ($attributes, $studentAttributes, &$student) {
			$user = $this->userRepository->create($attributes);

			$student = parent::create(array_merge($studentAttributes, ['user_id' => $user->id]));
		});

		return $student;
	}

    function model()
    {
        return Student::class;
    }

    public function boot()
    {
    	parent::boot();

    	$this->userRepository = app()->make(UserRepositoryContract::class);
    }
}