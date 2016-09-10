<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Models\User;
use Collejo\App\Models\Permission;
use Collejo\App\Models\Role;
use Hash;
use DB;

class UserRepository extends BaseRepository implements UserRepositoryContract {

	public function createAdminUser($name, $email, $password)
	{
		DB::transaction(function () use ($name, $email, $password) {

			$user = User::create([
					'first_name' => $name,
					'email' => $email,
					'password' => $password
				]);

			$this->syncUserRoles($user, ['admin']);
		});
	}

	public function getAdminUsers()
	{
		return $this->getRoleByName('admin')->users;
	}

	public function syncUserRoles(User $user, array $roleNames)
	{
		$roleIds = Role::whereIn('role', $roleNames)->get(['id'])->pluck('id')->all();
		$user->roles()->sync($this->createPrivotIds($roleIds));
	}

	public function addRoleToUser(User $user, Role $role)
	{
		if (!$this->userHasRole($user, $role)) {
			$user->roles()->attach($role, ['id' => $this->newUUID()]);
		}
	}

	public function userHasRole(User $user, Role $role)
	{
		return $user->roles->contains($role->id);
	}

	public function syncRolePermissions(Role $role, $permissions)
	{
		$permissionsIds = Permission::whereIn('permission', (array) $permissions)->get(['id'])->pluck('id')->all();
		$role->permissions()->sync($this->createPrivotIds($permissionsIds));
	}

	public function addPermissionToRole(Role $role, Permission $permission)
	{
		if (!$this->roleHasPermission($role, $permission)) {
			$role->permissions()->attach($permission, ['id' => $this->newUUID()]);
		}
	}

	public function roleHasPermission(Role $role, Permission $permission)
	{
		return $role->permissions->contains($permission->id);
	}

	public function createPermissionIfNotExists($permission)
	{
		if (is_null($this->getPermissionByName($permission))) {

			$permission = Permission::create(['permission' => $permission]);
		}
	}

	public function getRoleByName($name)
	{
		return Role::where('role', $name)->first();
	}

	public function getPermissionByName($name)
	{
		return Permission::where('permission', $name)->first();
	}

	public function createRoleIfNotExists($role)
	{
		if (is_null($this->getRoleByName($role))) {

			$role = Role::create(['role' => $role]);
		}
	}

	public function getRoles()
	{
		return $this->search(Role::class);
	}

	public function update(array $attributes, $id)
	{
		if (isset($attributes['password'])) {
		 	$attributes['password'] = Hash::make($attributes['password']);
		}

		return parent::update($attributes, $id);
	}

	public function create(array $attributes)
	{
		if (isset($attributes['password'])) {
		 	$attributes['password'] = Hash::make($attributes['password']);
		}

		return parent::create($this->parseFillable($attributes));
	}

	public function findByEmail($email)
	{
		return User::where('email', $email)->first();
	}
}