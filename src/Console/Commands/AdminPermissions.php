<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Container as Application;
use Module;

class AdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:permissions {--module=}';

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
        $module = $this->option('module');

        if (is_null($module)) {
            foreach (Module::all() as $module) {
                $this->processModule($app, $module);
            }
        } else {
            if (($module = Module::find($module))) {
                $this->processModule($app, $module);
            } else {
                $this->error('specified module not found');
            }
        }
    }

    private function processModule($app, $module)
    {
        $provider = $module->provider;

        $provider = new $provider($app);

        $provider->createPermissions();

        $this->info('Processing '.$module->name);
    }
}
