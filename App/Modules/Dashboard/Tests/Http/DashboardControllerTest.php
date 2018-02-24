<?php

namespace Collejo\App\Modules\Dashboard\Tests\Browser;

use Collejo\Foundation\Testing\TestCase;
use Collejo\App\Modules\ACL\Models\User;
use Auth;

class DashboardControllerTest extends TestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\Dashboard\Http\Controllers\DashController::getIndex()
     */
    public function testShowLoginForm()
    {
        $this->runDatabaseMigrations();

        $user = factory(User::class)->create();

        Auth::login($user, true);

        $response = $this->get(route('dash'));

        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
