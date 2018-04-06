<?php

namespace Collejo\App\Modules\Base\Tests\Browser;

use Collejo\Foundation\Testing\TestCase;

class AssetControllerTest extends TestCase
{

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\Base\Http\Controllers\AssetsController::getRoutes()
     */
    public function testGetRoutes()
    {
        $this->runDatabaseMigrations();

        $response = $this->get(route('routes.js'));

        $response->assertStatus(200);
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     * @covers \Collejo\App\Modules\Base\Http\Controllers\AssetsController::getLocals()
     */
    public function testGetLocals()
    {
        $this->runDatabaseMigrations();

        $response = $this->get(route('locale.js'));

        $response->assertStatus(200);
    }
}
