<?php

namespace Collejo\App\Modules\Dashboard\Tests\Browser;

use Collejo\Foundation\Testing\DuskTestCase;
use Laravel\Dusk\Browser;

class DashboardModuleTest extends DuskTestCase
{
    /**
     * Test if the module is loaded.
     *
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\Dashboard\Http\Controllers\DashController::getIndex()
     */
    public function testModuleLoaded()
    {
        $this->runDatabaseMigrations();

        $this->browse(function (Browser $browser) {
            $browser->visit(route('dash'))
                    ->assertSee(config('app.name'))
                    ->assertTitle(trans('dashabord::dash.dashboard').' - '.config('app.name'));
        });
    }
}
