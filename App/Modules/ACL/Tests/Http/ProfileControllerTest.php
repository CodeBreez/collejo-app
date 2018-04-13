<?php

namespace Collejo\App\Modules\ACL\Tests\Browser;

use Collejo\Foundation\Testing\TestCase;
use Collejo\App\Modules\ACL\Models\User;

class ProfileControllerTest extends TestCase
{

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\ACL\Http\Controllers\ProfileController::getProfile()
     */
    public function testGetProfile()
    {
        $this->runDatabaseMigrations();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('user.profile'))
            ->assertRedirect(route('user.details.view', $user->id));
    }
}
