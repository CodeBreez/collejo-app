<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>
 */
namespace Collejo\App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Collejo\App\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package Collejo\App\Console
 */
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
        Commands\AdminPermissions::class,
        Commands\PermissionList::class,
        Commands\ImageResize::class,
        Commands\AssetCopy::class,
        Commands\RouteCache::class,
        Commands\ConfigCache::class,
        Commands\Install::class,
        Commands\ModuleList::class,
        Commands\WidgetList::class,
        Commands\ThemeList::class,
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
