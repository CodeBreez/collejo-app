<?php

namespace Collejo\App\Modules\ACL\Contracts;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\App\Modules\ACL\Models\Permission;
use Collejo\App\Modules\ACL\Models\Role;

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