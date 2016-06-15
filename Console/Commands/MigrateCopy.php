<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use Collejo\Core\Foundation\Application;
use Module;
use DirectoryIterator;

class MigrateCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Module $module)
    {
        $this->info('Copying core migrations...');

        $migrationsLocation = realpath(__DIR__ . '/../../migrations');

        foreach (new DirectoryIterator($migrationsLocation) as $fileInfo) {
            if($fileInfo->isDot()) continue;

            copy($migrationsLocation . '/' . $fileInfo->getFilename(), base_path() . '/database/migrations/' . $fileInfo->getFilename());
        }

        return $this->call('migrate');
    }
}
