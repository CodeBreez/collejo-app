<?php

namespace Collejo\App\Repository;

use Collejo\App\Foundation\Repository\BaseRepository;
use Collejo\App\Contracts\Repository\GuardianRepository as GuardianRepositoryContract;
use Collejo\App\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Models\Guardian;
use Collejo\App\Models\Address;
use DB;

class GuardianRepository extends BaseRepository implements GuardianRepositoryContract {

	public function createGuardian(array $attributes)
	{
		$guardian = null;
		
		$guardianAttributes = $this->parseFillable($attributes, Guardian::class);
		$addressAttributes = $this->parseFillable($attributes, Address::class);

		DB::transaction(function () use ($attributes, $guardianAttributes, $addressAttributes, &$guardian) {
			$user = $this->userRepository->create($attributes);

			$guardian = Guardian::create(array_merge($guardianAttributes, ['user_id' => $user->id]));
			$address = Address::create(array_merge($addressAttributes, ['user_id' => $user->id, 'is_emergency' => true]));

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

	public function deleteAddress($addressId, $guardianId)
	{
		$this->findAddress($addressId, $guardianId)->delete();
	}

	public function updateAddress(array $attributes, $addressId, $guardianId)
	{
		$attributes['is_emergency'] = isset($attributes['is_emergency']);

		$this->findAddress($addressId, $guardianId)->update($attributes);

		return $this->findAddress($addressId, $guardianId);
	}

	public function createAddress(array $attributes, $guardianId)
	{
		$address = null;

		$guardian = $this->findGuardian($guardianId);

		$attributes['user_id'] = $guardian->user->id;
		$attributes['is_emergency'] = isset($attributes['is_emergency']);

		DB::transaction(function () use ($attributes, &$address) {
			$address = Address::create($attributes);
		});

		return $address;
	}

	public function findAddress($addressId, $guardianId)
	{
		return Address::where([
					'user_id' => $this->findGuardian($guardianId)->user->id, 
					'id' => $addressId]
				)->firstOrFail();
	}

	public function findGuardian($id)
	{
		return Guardian::findOrFail($id);
	}

	public function getGuardians($criteria)
	{
		return $this->search($criteria);
	}

    public function boot()
    {
    	parent::boot();

    	$this->userRepository = app()->make(UserRepositoryContract::class);
    }	
}