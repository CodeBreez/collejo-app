<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\App\Models\User;
use Hash;

class UserRepository extends BaseRepository {

	public function create(array $attributes)
	{
		$attributes['password'] = Hash::make($attributes['password']);

		return parent::create($attributes);
	}

    function model()
    {
        return User::class;
    }
}