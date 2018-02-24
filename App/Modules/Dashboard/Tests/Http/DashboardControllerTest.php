<?php

namespace Collejo\App\Modules\Dashboard\Tests\Browser;

use Auth;
use Collejo\Foundation\Testing\TestCase;

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
