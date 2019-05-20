<?php

namespace Collejo\App\Modules\Auth\Tests\Browser;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\TestCase;

class ProfileControllerTest extends TestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function testGetProfile()
    {
        $this->runDatabaseMigrations();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('user.profile'))
            ->assertViewIs('auth::view_profile_details');
    }
}
