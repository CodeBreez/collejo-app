<?php

namespace Collejo\App\Modules\ACL\Tests;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\Permission;
use Collejo\App\Modules\ACL\Models\Role;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryACLTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $userRepository;

    /**
     * @covers UserRepository::findByEmail()
     * @covers UserRepository::create()
     */
    public function testFindByEmail()
    {
        $userAttributes = factory(User::class)->make();

        $user = $this->userRepository->create($userAttributes->toArray());

        $userFetched = $this->userRepository->findByEmail($user->email);

        $this->assertEquals($user->id, $userFetched->id);
    }

    /**
     * @covers UserRepository::findRole()
     */
    public function testFindRole()
    {
        $role = factory(Role::class)->create();

        $roleFetched = $this->userRepository->findRole($role->id);

        $this->assertArrayValuesEquals($role, $roleFetched);
    }

    /**
     * @covers UserRepository::createRoleIfNotExists()
     */
    public function testCreateRoleIfNotExists()
    {
        $this->runDatabaseMigrations();

        $role = $this->userRepository->createRoleIfNotExists('test_role');

        $roleFetched = Role::find($role->id);

        $this->assertArrayValuesEquals($role, $roleFetched);
    }

    /**
     * @covers UserRepository::getPermissionsByModule()
     */
    public function testGetPermissionsByModule()
    {
        $this->runDatabaseMigrations();

        $permissions = factory(Permission::class, 5)->create();

        $permissionsFetched = $this->userRepository->getPermissionsByModule('test');

        $this->assertArraysEquals($permissions->pluck('id')->sort(), $permissionsFetched->pluck('id')->sort());
    }

    /**
     * @covers UserRepository::getPermissionByName()
     */
    public function testGetPermissionByName()
    {
        $this->runDatabaseMigrations();

        $permission = factory(Permission::class)->create();

        $permissionFetched = $this->userRepository->getPermissionByName($permission->permission);

        $this->assertEquals($permission->id, $permissionFetched->id);
    }

    /**
     * @covers UserRepository::getRoleByName()
     */
    public function testGetRoleByName()
    {
        $this->runDatabaseMigrations();

        $role = factory(Role::class)->create();

        $roleFetched = $this->userRepository->getRoleByName($role->role);

        $this->assertEquals($role->id, $roleFetched->id);
    }

    /**
     * @covers UserRepository::enableRole()
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
     * @covers UserRepository::disableRole()
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
     * @covers UserRepository::createPermissionIfNotExists()
     */
    public function testCreatePermissionIfNotExists()
    {
        $this->runDatabaseMigrations();

        $permission = $this->userRepository->createPermissionIfNotExists('test_permission', 'test');

        $permissionFetched = Permission::find($permission->id);

        $this->assertArrayValuesEquals($permission, $permissionFetched);
    }

    /**
     * @covers UserRepository::syncRolePermissions()
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
     * @covers UserRepository::addRoleToUser()
     * @covers UserRepository::userHasRole()
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
     * @covers UserRepository::syncUserRoles()
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
     * @covers UserRepository::addPermissionToRole()
     * @covers UserRepository::roleHasPermission()
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
