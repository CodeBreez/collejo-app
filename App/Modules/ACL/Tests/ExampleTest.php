<?php

namespace Collejo\App\Modules\ACL\Tests;

use Collejo\Foundation\Testing\DuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Collejo');
        });
    }
}
