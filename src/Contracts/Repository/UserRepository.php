<?php

namespace Collejo\App\Contracts\Repository;

use Collejo\App\Models\User;
use Collejo\App\Models\Permission;
use Collejo\App\Models\Role;

interface UserRepository
{
	public function createAdminUser($name, $email, $password);

	public function getAdminUsers();

	public function syncUserRoles(User $user, array $roleNames);

	public function addRoleToUser(User $user, Role $role);

	public function userHasRole(User $user, Role $role);

	public function syncRolePermissions(Role $role, array $permissions);

	public function addPermissionToRole(Role $role, Permission $permission);

	public function roleHasPermission(Role $role, Permission $permission);

	public function createPermissionIfNotExists($permission, $module = null);

	public function getRoleByName($name);

	public function getPermissionByName($name);

	public function createRoleIfNotExists($role);

	public function create(array $attributes);

	public function findByEmail($email);

}