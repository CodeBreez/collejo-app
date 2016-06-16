<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\App\Models\User;
use Hash;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use DB;

class UserRepository extends BaseRepository implements UserRepositoryContract {

	public function createAdminUser($name, $email, $password)
	{
		DB::transaction(function () {

			$user = $this->create([
					'first_name' => $name,
					'email' => $email,
					'password' => $password
				]);

			$this->assignRoles($user, []);

		});
	}

	public function assignRoles()
	{
		
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