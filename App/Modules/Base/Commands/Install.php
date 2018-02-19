<?php

namespace Collejo\App\Modules\Base\Commands;

use Illuminate\Foundation\Console\ConfigCacheCommand;

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
            $this->error('Collejo is already installed. Bye.');
            exit();
        }

        $this->call('migrate');

        $this->info(" ,-----.         ,--. ,--.           ,--.         ");
        $this->info("'  .--./  ,---.  |  | |  |  ,---.    `--'  ,---.  ");
        $this->info("|  |     | .-. | |  | |  | | .-. :   ,--. | .-. | ");
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
