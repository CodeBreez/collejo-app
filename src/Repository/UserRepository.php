<?php

namespace Collejo\App\Repository;

use Collejo\App\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Foundation\Repository\BaseRepository;
use Collejo\App\Models\Permission;
use Collejo\App\Models\Role;
use Collejo\App\Models\User;
use Hash;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function createAdminUser($name, $email, $password)
    {
        $user = User::create([
                'first_name' => $name,
                'email'      => $email,
                'password'   => Hash::make($password),
            ]);

        $this->addRoleToUser($user, $this->getRoleByName('admin'));

        return $user;
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

        $role->permissions()->sync($this->createPrivotIds($permissionIds));
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

    public function createPermissionIfNotExists($permission, $module = null)
    {
        $perm = $this->getPermissionByName($permission);

        if (is_null($perm)) {
            $perm = Permission::create(['permission' => $permission, 'module' => $module]);
        }

        return $perm;
    }

    public function disableRole($roleId)
    {
        $this->findRole($roleId)->delete();
    }

    public function enableRole($roleId)
    {
        Role::withTrashed()->findOrFail($roleId)->restore();
    }

    public function getRoleByName($name)
    {
        return Role::where('role', $name)->first();
    }

    public function getPermissionByName($name)
    {
        return Permission::where('permission', $name)->first();
    }

    public function getPermissionsByModule($name)
    {
        return Permission::where('module', strtolower($name))->get();
    }

    public function createRoleIfNotExists($roleName)
    {
        if (is_null($role = $this->getRoleByName($roleName))) {
            $role = Role::create(['role' => $roleName]);
        }

        return $role;
    }

    public function getRoles()
    {
        return new Role();
    }

    public function getPermissions()
    {
        return new Permission();
    }

    public function findRole($id)
    {
        return Role::findOrFail($id);
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return User::findOrFail($id)->update($attributes);
    }

    public function create(array $attributes)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return User::create($this->parseFillable($attributes, User::class));
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
