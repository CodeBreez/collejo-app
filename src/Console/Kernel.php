<?php

namespace Collejo\App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Collejo\Core\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\MigrateCopy::class,
        Commands\AdminCreate::class,
        Commands\AssetCopy::class,
        Commands\RouteCache::class,
        Commands\ConfigCache::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }
}
