<?php

namespace Collejo\App\Modules\Students\Repositories;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\Students\Contracts\GuardianRepository as GuardianRepositoryContract;
use Collejo\App\Modules\Students\Models\Guardian;
use Collejo\Foundation\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

class GuardianRepository extends BaseRepository implements GuardianRepositoryContract
{

    /**
     * Create new guardian with the given attributes
     *
     * @param array $attributes
     * @return null
     */
    public function createGuardian(array $attributes)
    {
        $guardian = null;

        $guardianAttributes = $this->parseFillable($attributes, Guardian::class);

        DB::transaction(function () use ($attributes, $guardianAttributes, &$guardian) {
            $user = $this->userRepository->create($attributes);

            $guardian = Guardian::make($guardianAttributes);

            $guardian->user()->associate($user)->save();

            $this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('guardian'));
        });

        return $guardian;
    }

    /**
     * Update a guardian with the given id and attributes
     *
     * @param array $attributes
     * @param $guardianId
     * @return mixed
     */
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

    /**
     * Get guardian by id
     *
     * @param $id
     * @return mixed
     */
    public function findGuardian($id)
    {
        return Guardian::findOrFail($id);
    }

    /**
     * Get guardians by the given criteria.
     *
     * @param $criteria
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getGuardians($criteria)
    {
        return $this->search($criteria);
    }

    public function boot()
    {
        parent::boot();

        $this->userRepository = app()->make(UserRepository::class);
    }
}
