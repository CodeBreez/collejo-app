<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */
namespace Collejo\App\Console\Commands;

use Illuminate\Foundation\Console\ConfigCacheCommand;

/**
 * Class Install.
 */
class Install extends ConfigCacheCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Collejo';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (app()->isInstalled()) {
            $this->error('Collejo is already installed. Exiting.');
            $this->info('Use artisan command `php artisan admin:create` to create an admin account.');
            exit();
        }

        $this->call('migrate:copy');

        $this->info(' ,-----.         ,--. ,--.           ,--.         ');
        $this->info("'  .--./  ,---.  |  | |  |  ,---.    `--'  ,---.  ");
        $this->info('|  |     | .-. | |  | |  | | .-. :   ,--. | .-. | ');
        $this->info("'  '--'\ ' '-' ' |  | |  | \   --.   |  | ' '-' ' ");
        $this->info(" `-----'  `---'  `--' `--'  `----' .-'  /  `---'  ");
        $this->info("                                   '---'          ");

        $this->info('Done');

        $this->info('Creating Admin Account');

        $this->call('admin:create');

        $this->info('Done');

        $this->info('Creating Permissions');

        $this->call('admin:permissions');

        $this->info('Done');

        $this->info('Setup complete');
        $this->info('Documentation can be found at https://github.com/codebreez/collejo-docs');
    }
}
