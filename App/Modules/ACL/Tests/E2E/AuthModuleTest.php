<?php

namespace Collejo\App\Modules\ACL\Tests\E2E;

use Collejo\Foundation\Testing\DuskTestCase;
use Laravel\Dusk\Browser;

class AuthModuleTest extends DuskTestCase
{
    /**
     * Test if the module is loading
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testModuleLoaded()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Collejo');
        });
    }
}
