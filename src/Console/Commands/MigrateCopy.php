<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */

namespace Collejo\App\Console\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;

/**
 * Class MigrateCopy.
 */
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
        $this->info('Copying core migrations');

        $src = realpath(__DIR__.'/../../migrations');
        $dest = base_path('database/migrations');

        if (!file_exists($dest)) {
            mkdir($dest);
        }

        array_map('unlink', glob($dest.'/*'));

        foreach (new DirectoryIterator($src) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }

            copy($src.'/'.$fileInfo->getFilename(), $dest.'/'.$fileInfo->getFilename());
        }

        return $this->call('migrate');
    }
}
