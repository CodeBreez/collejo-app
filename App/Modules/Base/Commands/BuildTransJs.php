<?php

namespace Collejo\App\Modules\Base\Commands;

use Illuminate\Console\Command;

class BuildTransJs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:trans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build Trans JS';

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
                    $langsDir = $path.'/'.$dir.'/resources/lang';

                    if (is_dir($langsDir)) {
                        foreach (listDir($langsDir) as $lang) {
                            $langDir = $langsDir.'/'.$lang;

                            $strings = [];

                            foreach (listDir($langDir) as $file) {
                                $langFile = $langDir.'/'.$file;

                                $strings[basename($file, '.php')] = require $langFile;
                            }

                            $filePath = storage_path().'/collejo/trans/'.snake_case($dir);

                            if (!is_dir($filePath)) {
                                mkdir($filePath, 0755, true);
                            }

                            $handle = fopen($filePath.'/'.$lang.'.js', 'w');

                            fwrite($handle, 'C.langs[\''.$lang.'\'][\''.snake_case($dir).'\']='.json_encode($strings));

                            fclose($handle);
                        }
                    }
                }
            }
        }

        $this->info('Lang files updated!');
    }
}
