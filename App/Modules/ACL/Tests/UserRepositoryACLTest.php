<?php

namespace Collejo\App\Modules\ACL\Tests;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\Permission;
use Collejo\App\Modules\ACL\Models\Role;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryACLTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $userRepository;

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::findByEmail()
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::create()
     */
    public function testFindByEmail()
    {
        $userAttributes = factory(User::class)->make();

        $user = $this->userRepository->create($userAttributes->toArray());

        $userFetched = $this->userRepository->findByEmail($user->email);

        $this->assertEquals($user->id, $userFetched->id);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::findRole()
     */
    public function testFindRole()
    {
        $role = factory(Role::class)->create();

        $roleFetched = $this->userRepository->findRole($role->id);

        $this->assertArrayValuesEquals($role, $roleFetched);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::createRoleIfNotExists()
     */
    public function testCreateRoleIfNotExists()
    {
        $this->runDatabaseMigrations();

        $role = $this->userRepository->createRoleIfNotExists('test_role');

        $roleFetched = Role::find($role->id);

        $this->assertArrayValuesEquals($role, $roleFetched);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::getPermissionsByModule()
     */
    public function testGetPermissionsByModule()
    {
        $this->runDatabaseMigrations();

        $permissions = factory(Permission::class, 5)->create();

        $permissionsFetched = $this->userRepository->getPermissionsByModule('test');

        $this->assertArraysEquals($permissions->pluck('id')->sort(), $permissionsFetched->pluck('id')->sort());
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::getPermissionByName()
     */
    public function testGetPermissionByName()
    {
        $this->runDatabaseMigrations();

        $permission = factory(Permission::class)->create();

        $permissionFetched = $this->userRepository->getPermissionByName($permission->permission);

        $this->assertEquals($permission->id, $permissionFetched->id);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::getRoleByName()
     */
    public function testGetRoleByName()
    {
        $this->runDatabaseMigrations();

        $role = factory(Role::class)->create();

        $roleFetched = $this->userRepository->getRoleByName($role->role);

        $this->assertEquals($role->id, $roleFetched->id);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::enableRole()
     */
    public function testEnableRole()
    {
        $this->runDatabaseMigrations();

        $role = factory(Role::class)->create();

        $role->delete();

        $this->userRepository->enableRole($role->id);

        $role = Role::withTrashed()->where('id', $role->id)->firstOrFail();

        $this->assertFalse($role->trashed());
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::disableRole()
     */
    public function testDisableRole()
    {
        $this->runDatabaseMigrations();

        $role = factory(Role::class)->create();

        $this->userRepository->disableRole($role->id);

        $role = Role::withTrashed()->where('id', $role->id)->firstOrFail();

        $this->assertTrue($role->trashed());
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::createPermissionIfNotExists()
     */
    public function testCreatePermissionIfNotExists()
    {
        $this->runDatabaseMigrations();

        $permission = $this->userRepository->createPermissionIfNotExists('test_permission', 'test');

        $permissionFetched = Permission::find($permission->id);

        $this->assertArrayValuesEquals($permission, $permissionFetched);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::syncRolePermissions()
     */
    public function testSyncRolePermissions()
    {
        $this->runDatabaseMigrations();

        $permissions = factory(Permission::class, 5)->create();

        $role = factory(Role::class)->create();

        $this->userRepository->syncRolePermissions($role, $permissions->pluck('permission')->toArray());

        $role = Role::find($role->id);

        $rolePermissionsArray = $role->permissions->pluck('id')->sort();
        $permissionsArray = $permissions->pluck('id')->sort();

        $this->assertArraysEquals($rolePermissionsArray, $permissionsArray);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::addRoleToUser()
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::userHasRole()
     */
    public function testAddRoleToUser()
    {
        $user = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $this->userRepository->addRoleToUser($user, $role);

        $user = User::find($user->id);
        $role = Role::find($role->id);

        $this->assertTrue($this->userRepository->userHasRole($user, $role));
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::syncUserRoles()
     */
    public function testSyncUserRoles()
    {
        $this->runDatabaseMigrations();

        $roles = factory(Role::class, 5)->create();

        $user = factory(User::class)->create();

        $this->userRepository->syncUserRoles($user, $roles->pluck('role')->toArray());

        $user = User::find($user->id);

        $userRolesArray = $user->roles->pluck('id')->sort();
        $rolesArray = $roles->pluck('id')->sort();

        $this->assertArraysEquals($userRolesArray, $rolesArray);
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::addPermissionToRole()
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::roleHasPermission()
     */
    public function testRolePermission()
    {
        $this->runDatabaseMigrations();

        $permission = factory(Permission::class)->create();

        $role = factory(Role::class)->create();

        $this->userRepository->addPermissionToRole($role, $permission);

        $permission = Permission::find($permission->id);
        $role = Role::find($role->id);

        $this->assertTrue($this->userRepository->roleHasPermission($role, $permission));
    }

    public function setup()
    {
        parent::setup();

        $this->userRepository = $this->app->make(UserRepository::class);
    }
}
