<?php

namespace Collejo\App\Modules\Auth\Tests\Browser;

use Collejo\Foundation\Testing\DuskTestCase;
use Laravel\Dusk\Browser;

class AuthModuleTest extends DuskTestCase
{
    /**
     * Test if the module is loaded.
     *
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\Auth\Http\Controllers\LoginController::showLoginForm()
     */
    public function testModuleLoaded()
    {
        $this->runDatabaseMigrations();

        sleep(3);

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee(config('app.name'))
                    ->assertTitle(trans('auth::auth.login').' - '.config('app.name'));
        });
    }
}
