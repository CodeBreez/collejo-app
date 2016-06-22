<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use Collejo\Core\Foundation\Application;
use Module;
use DirectoryIterator;

class AssetCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copies asset files and recreates the asset cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Module $module)
    {
        $this->info('Copying core assets...');

        $assetDir = realpath(__DIR__ . '/../../resources/assets');

        $assetLocations = [
            [$assetDir . '/build/js', 'js', true],
            [$assetDir . '/build/css', 'css', true],
            [$assetDir . '/fonts', 'fonts', false],
            [$assetDir . '/images', 'images', true]
        ];

        $publicDir = base_path('public');

        $manifest = [];

        foreach ($assetLocations as $location) {

            $src = $location[0];
            $dest = $location[1];
            $versioned = $location[2];

            $destDir = $publicDir . '/' . $dest . '/';

            if (!file_exists($destDir)) {
                mkdir($destDir, 0755, true);
            } 

            array_map('unlink', glob($destDir . '/*'));

            foreach (new DirectoryIterator($src) as $fileInfo) {
                if($fileInfo->isDot()) continue;

                if ($versioned) {

                    $destFileName = md5($fileInfo->getFilename() . microtime(true)) . '-' . $fileInfo->getFilename();

                    $manifest['/' . $dest . '/' . $fileInfo->getFilename()] = '/' . $dest . '/' . $destFileName;

                } else {
                    $destFileName = $fileInfo->getFilename();
                }

                copy($src . '/' . $fileInfo->getFilename(), $destDir . $destFileName);
            }
        }

        $fn = fopen(storage_path('rev-manifest.json'), 'w');

        fwrite($fn, json_encode($manifest, JSON_PRETTY_PRINT));

        fclose($fn);
    }
}
