<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\StudentRepository as StudentRepositoryContract;
use Collejo\App\Models\Student;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use DB;

class StudentRepository extends BaseRepository implements StudentRepositoryContract {

	protected $userRepository;

	protected $fillable;

	public function create(array $attributes)
	{
		if ($this->sessionOwner) {
			$attributes['enrolled_by'] = $this->sessionOwner->id;
		}

		$studentAttributes = $this->parseFillable($attributes);

		DB::transaction(function () use ($attributes, $studentAttributes) {
			$user = $this->userRepository->create($attributes);

			$student = parent::create(array_merge($studentAttributes, ['user_id' => $user->id]));
		});
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