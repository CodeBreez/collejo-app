<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
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
    public function handle()
    {
        $this->info('Copying core migrations...');

        $src = realpath(__DIR__ . '/../../migrations');
        $dest = base_path('database/migrations');

        array_map('unlink', glob($dest . '/*'));

        foreach (new DirectoryIterator($src) as $fileInfo) {
            if($fileInfo->isDot()) continue;

            copy($src . '/' . $fileInfo->getFilename(), $dest . '/' . $fileInfo->getFilename());
        }

        return $this->call('migrate');
    }
}
