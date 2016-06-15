<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\App\Models\User;
use Hash;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract {

	public function createAdminUser($name, $email, $password)
	{
		$user = $this->create([
				'first_name' => $name,
				'email' => $email,
				'password' => $password
			]);
	}

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