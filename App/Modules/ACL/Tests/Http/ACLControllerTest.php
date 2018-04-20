<?php

namespace Collejo\App\Modules\ACL\Tests\Browser;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\CreatesUsers;
use Collejo\Foundation\Testing\TestCase;

class ACLControllerTest extends TestCase
{
    use CreatesUsers;

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\ACL\Http\Controllers\ACLController::getUserDetailsEdit()
     */
    public function testGetUserDetailsEdit()
    {
        $this->runDatabaseMigrations();

        $user = factory(User::class)->create();

        $this->actingAs($this->createAdminUser('edit_user_account_info'))
            ->get(route('user.details.edit', $user->id))
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

        $user = factory(User::class)->create();

        $this->actingAs($this->createAdminUser('view_user_account_info'))
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

        $this->actingAs($this->createAdminUser('view_user_account_info'))
            ->get(route('users.manage'))
            ->assertSuccessful();
    }
}
