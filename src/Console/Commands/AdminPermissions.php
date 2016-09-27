<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use DirectoryIterator;
use Module;
use Illuminate\Container\Container as Application;

class AdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rescans providers and assings all permissions to admins';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Application $app)
    {
        foreach (Module::all() as $module) {

            $provider = $module->provider;

            $provider = new $provider($app);

            $provider->createPermissions();

            $this->info('Processing ' . $module->name);
        }
        
    }
}
