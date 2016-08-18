<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
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
    protected $description = 'Copies asset files from Collejo assets directory and recreates the asset manifest';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = microtime(true);

        $this->info('Copying core assets...');

        $srcDir = realpath(__DIR__ . '/../../resources/assets/');

        $assetLocations = [
            ['js', true],
            ['css', true],
            ['fonts', false],
            ['images', true]
        ];

        $publicDir = base_path('public');

        $manifest = [];

        if (!file_exists(base_path('public/build'))) {
            mkdir(base_path('public/build'), 0755, true);
        }

        foreach ($assetLocations as $location) {

            $dir = $location[0];
            $versioned = $location[1];

            $assetDir = $publicDir . '/' . $dir . '/';
            $buildDir = $publicDir . '/build/' . $dir . '/';

            if (!file_exists($assetDir)) {
                mkdir($assetDir, 0755, true);
            } 

            if (!file_exists($buildDir)) {
                mkdir($buildDir, 0755, true);
            } 

            array_map('unlink', glob($assetDir . '/*'));
            array_map('unlink', glob($buildDir . '/*'));

            foreach (new DirectoryIterator($srcDir . '/' . $dir) as $fileInfo) {
                if($fileInfo->isDot()) continue;

                $regularFilePath = '/' . $dir . '/' . $fileInfo->getFilename();

                if ($versioned) {

                    $versionedName = md5($fileInfo->getFilename() . microtime(true)) . '-' . $fileInfo->getFilename();

                    $manifest[$regularFilePath] = $dir . '/' . $versionedName;

                } else {
                    $versionedName = $fileInfo->getFilename();
                }

                copy($srcDir . '/' . $dir . '/' . $fileInfo->getFilename(), $assetDir . $fileInfo->getFilename());
                copy($srcDir . '/' . $dir . '/' . $fileInfo->getFilename(), $buildDir . $versionedName);
            }
        }

        $fn = fopen(base_path('public/build/rev-manifest.json'), 'w');

        fwrite($fn, json_encode($manifest, JSON_PRETTY_PRINT));

        fclose($fn);

        $this->info('Finished in ' . round(microtime(true) - $startTime, 3) * 1000);
    }
}
