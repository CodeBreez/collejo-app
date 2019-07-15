<?php

namespace Collejo\App\Console;

use Collejo\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        $this->registerModuleCommands();

        require base_path('routes/console.php');
    }

    private function registerModuleCommands()
    {
        $modules = app()->make('modules');

        foreach ($modules->getModulePaths() as $path) {
            if (file_exists($path)) {
                foreach (listDir($path) as $dir) {
                    $commandsDir = $path.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.'Commands';

                    $this->load($commandsDir);
                }
            }
        }
    }
}
