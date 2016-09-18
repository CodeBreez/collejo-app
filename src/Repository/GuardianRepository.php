<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\GuardianRepository as GuardianRepositoryContract;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Models\Guardian;
use DB;

class GuardianRepository extends BaseRepository implements GuardianRepositoryContract {

	public function createGuardian(array $attributes)
	{
		$guardian = null;
		
		$guardianAttributes = $this->parseFillable($attributes, Guardian::class);

		DB::transaction(function () use ($attributes, $guardianAttributes, &$guardian) {
			$user = $this->userRepository->create($attributes);

			$guardian = Guardian::create(array_merge($guardianAttributes, ['user_id' => $user->id]));

			$this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('guardian'));
		});

		return $guardian;
	}

	public function updateGuardian(array $attributes, $guardianId)
	{
		$guardian = $this->findGuardian($guardianId);

		$guardianAttributes = $this->parseFillable($attributes, Guardian::class);

		DB::transaction(function () use ($attributes, $guardianAttributes, &$guardian, $guardianId) {
			$guardian->update($guardianAttributes);

			$user = $this->userRepository->update($attributes, $guardian->user->id);
		});

		return $guardian;
	}
	public function findGuardian($id)
	{
		return Guardian::findOrFail($id);
	}

	public function getGuardians()
	{
		return $this->search(Guardian::class);
	}

    public function boot()
    {
    	parent::boot();

    	$this->userRepository = app()->make(UserRepositoryContract::class);
    }	
}