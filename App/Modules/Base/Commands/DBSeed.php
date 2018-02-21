<?php

namespace Collejo\App\Modules\Base\Commands;

use Illuminate\Console\Command;

class DBSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds the database with data';

    public function __construct()
    {
        parent::__construct();

        $this->modules = app()->make('modules');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->modules->getModulePaths() as $path) {
            if (file_exists($path)) {
                foreach (listDir($path) as $dir) {
                    $seedsDir = $path.'/'.$dir.'/Seeder';

                    if (is_dir($seedsDir)) {
                        foreach (listDir($seedsDir) as $seeder) {
                            $seeder = 'Collejo\App\Modules\\'.$dir.'\Seeder\\'.substr($seeder, 0, strlen($seeder) - 4);

                            $this->info('Seeding : '.$seeder);

                            $class = new $seeder();

                            $class->setCommand($this)->__invoke();
                        }
                    }
                }
            }
        }

        $this->info('Database seeded!');
    }
}
