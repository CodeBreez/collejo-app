<?php

namespace Collejo\App\Modules\ACL\Tests\Browser;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\TestCase;

class ACLControllerTest extends TestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\ACL\Http\Controllers\ACLController::getUserDetailsEdit()
     */
    public function testGetUserDetailsEdit()
    {
        $this->runDatabaseMigrations();

        $admin = $this->userRepository->createAdminUser('test', 'test@test.com', '123');

        $user = factory(User::class)->create();

        $this->actingAs($admin)
            ->get(route('user.details.view', $user->id))
            ->assertSuccessful();
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\ACL\Http\Controllers\ACLController::getUserDetailsView()
     */
    public function testGetUserDetailsView()
    {
        $this->runDatabaseMigrations();

        $admin = $this->userRepository->createAdminUser('test', 'test@test.com', '123');

        $user = factory(User::class)->create();

        $this->actingAs($admin)
            ->get(route('user.details.view', $user->id))
            ->assertSuccessful();
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\ACL\Http\Controllers\ACLController::getManage()
     */
    public function testGetManage()
    {
        $this->runDatabaseMigrations();

        $admin = $this->userRepository->createAdminUser('test', 'test@test.com', '123');

        $this->actingAs($admin)
            ->get(route('users.manage'))
            ->assertSuccessful();
    }

    public function setup()
    {
        parent::setup();

        $this->userRepository = $this->app->make(UserRepository::class);
    }
}
