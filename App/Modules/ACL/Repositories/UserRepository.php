<?php

namespace Collejo\App\Modules\ACL\Repositories;

use Collejo\App\Modules\ACL\Contracts\UserRepository as UserRepositoryContract;
use Collejo\App\Modules\ACL\Criteria\UserListCriteria;
use Collejo\App\Modules\ACL\Models\Permission;
use Collejo\App\Modules\ACL\Models\Role;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Repository\BaseRepository;
use Hash;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * Creates an admin user by the given details.
     *
     * @param $name
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function createAdminUser($name, $email, $password)
    {
        $user = $this->create([
            'first_name' => $name,
            'email'      => $email,
            'password'   => $password,
        ]);

        $this->addRoleToUser($user, $this->getRoleByName('admin'));

        return $user;
    }

    /**
     * Returns a collection of admin users.
     *
     * @return mixed
     */
    public function getAdminUsers()
    {
        return $this->getRoleByName('admin')->users;
    }

    /**
     * Sync user roles with the given User model.
     *
     * @param User  $user
     * @param array $roleNames
     */
    public function syncUserRoles(User $user, array $roleNames)
    {
        $roleIds = Role::whereIn('role', $roleNames)->get(['id'])->pluck('id')->all();

        $this->assignRolesToUser($roleIds, $user->id);
    }

    /**
     * @param $user
     * @param $roleIds
     */
    public function assignRolesToUser(array $roleIds, $userId)
    {
        $this->findUser($userId)->roles()->sync($this->createPivotIds($roleIds));
    }

    /**
     * Adds the given Role model to the User model.
     *
     * @param User $user
     * @param Role $role
     */
    public function addRoleToUser(User $user, Role $role)
    {
        if (!$this->userHasRole($user, $role)) {
            $user->roles()->attach($role, ['id' => $this->newUUID()]);
        }
    }

    /**
     * Checks if the given User model has the given Role model.
     *
     * @param User $user
     * @param Role $role
     *
     * @return mixed
     */
    public function userHasRole(User $user, Role $role)
    {
        return $user->hasRole($role->role);
    }

    /**
     * Syncs given role's permissions, optionally a module name is supported.
     *
     * @param Role  $role
     * @param array $permissions
     * @param null  $module
     */
    public function syncRolePermissions(Role $role, array $permissions, $module = null)
    {
        if (!is_null($module)) {
            $otherPermissions = $role->permissions()
                                ->where('module', '!=', strtolower($module))->get()
                                ->pluck('permission')->all();

            $permissions = array_merge($otherPermissions, $permissions);
        }

        $permissionIds = Permission::whereIn('permission', (array) $permissions)->get(['id'])
                                ->pluck('id')->all();

        $role->permissions()->sync($this->createPivotIds($permissionIds));
    }

    /**
     * Adds a given Permission to the given Role.
     *
     * @param Role       $role
     * @param Permission $permission
     */
    public function addPermissionToRole(Role $role, Permission $permission)
    {
        if (!$this->roleHasPermission($role, $permission)) {
            $role->permissions()->attach($permission, ['id' => $this->newUUID()]);
        }
    }

    /**
     * Checks of the given Permission is in the given Role.
     *
     * @param Role       $role
     * @param Permission $permission
     *
     * @return mixed
     */
    public function roleHasPermission(Role $role, Permission $permission)
    {
        return $role->permissions->contains($permission->id);
    }

    /**
     * Creates a Permission if it's not in the database.
     *
     * @param $permission
     * @param null $module
     *
     * @return mixed
     */
    public function createPermissionIfNotExists($permission, $module = null)
    {
        $perm = $this->getPermissionByName($permission);

        if (is_null($perm)) {
            $perm = Permission::create(['permission' => $permission, 'module' => $module]);
        }

        return $perm;
    }

    /**
     * Soft deletes a Role.
     *
     * @param $roleId
     */
    public function disableRole($roleId)
    {
        $this->findRole($roleId)->delete();
    }

    /**
     * Undo a soft deleted Role.
     *
     * @param $roleId
     */
    public function enableRole($roleId)
    {
        Role::withTrashed()->findOrFail($roleId)->restore();
    }

    /**
     * Returns a Role by it's name.
     *
     * @param $name
     *
     * @return mixed
     */
    public function getRoleByName($name)
    {
        return Role::where('role', $name)->first();
    }

    /**
     * Returns a Permission by it's name.
     *
     * @param $name
     *
     * @return mixed
     */
    public function getPermissionByName($name)
    {
        return Permission::where('permission', $name)->first();
    }

    /**
     * Returns an array of Permissions for the given module.
     *
     * @param $name
     *
     * @return mixed
     */
    public function getPermissionsByModule($name)
    {
        return Permission::where('module', strtolower($name))->get();
    }

    /**
     * Creates a Role if it's not in the database.
     *
     * @param $roleName
     *
     * @return mixed
     */
    public function createRoleIfNotExists($roleName)
    {
        if (is_null($role = $this->getRoleByName($roleName))) {
            $role = Role::create(['role' => $roleName]);
        }

        return $role;
    }

    /**
     * Returns a collection for Users.
     *
     * @param UserListCriteria $criteria
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getUsers(UserListCriteria $criteria)
    {
        return $this->search($criteria);
    }

    /**
     * Returns a collection for Roles.
     *
     * @return Role
     */
    public function getRoles()
    {
        return new Role();
    }

    /**
     * Returns a collection for Permissions.
     *
     * @return Permissions
     */
    public function getPermissions()
    {
        return new Permission();
    }

    /**
     * Returns a Role by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findRole($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Update a User by id.
     *
     * @param array $attributes
     * @param $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return User::findOrFail($id)->update($attributes);
    }

    /**
     * Creates a new User by given details.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return User::create($this->parseFillable($attributes, User::class));
    }

    /**
     * Returns a user by the given email.
     *
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Find a user by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findUser($id, $with = null)
    {
        if ($with) {
            return User::with($with)->findOrFail($id);
        }

        return User::findOrFail($id);
    }
}
