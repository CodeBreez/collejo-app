<?php

namespace Collejo\App\Modules\ACL\Commands;

use Illuminate\Console\Command;
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
    protected $description = 'Re-scans providers and assigns all permissions to admins';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Application $app)
    {
        $modules = app()->make('modules');

        foreach ($modules->getModulePaths() as $path) {
            if (file_exists($path)) {
                foreach (listDir($path) as $dir) {
                    if (is_dir($path.'/'.$dir)) {
                        $provider = 'Collejo\App\Modules\\'.$dir.'\Providers\\'.$dir.'ModuleServiceProvider';
                        $this->processModule($provider);
                    }
                }
            }
        }
    }

    private function processModule($providerName)
    {
        $provider = new $providerName(app());

        $this->info('Processing : '.$provider->getModuleName());

        $provider->createPermissions();
    }
}
