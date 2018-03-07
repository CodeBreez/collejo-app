<?php

namespace Collejo\App\Console\Commands;

use Collejo\App\Models\Media;
use Exception;
use Illuminate\Foundation\Console\ConfigCacheCommand;
use Illuminate\Support\Facades\File;
use Image;
use Storage;

/**
 * Class ImageResize.
 */
class ImageResize extends ConfigCacheCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resizes all images to predefined sized';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (config('uploader') as $bucket => $config) {
            if (isset($config['resize'])) {
                $disk = Storage::disk($config['disk']);

                $this->info('Processing '.$bucket);

                foreach (Media::where('bucket', $bucket)->get() as $image) {
                    $srcFile = $config['path'].'/original/'.$image->fileName;

                    $this->info('Source File '.$srcFile);

                    try {
                        if (!$disk->has($srcFile)) {
                            throw new Exception('File not found on source directory');
                        }

                        foreach ($config['resize'] as $name => $size) {
                            $temp = tempnam(storage_path('tmp'), 'tmp');

                            $file = $disk->get($srcFile);

                            Image::make($file)->fit($size[0], $size[1])->save($temp);

                            $destName = $config['path'].'/'.$name.'/'.$image->fileName;

                            $disk->put($destName, File::get($temp));

                            unlink($temp);

                            $this->info(str_pad($name, 10).' >> '.$destName);
                        }
                    } catch (Exception $e) {
                        $this->error('Failed to process image. ERR:'.$e->getMessage());
                    }
                }
            }
        }
    }
}
