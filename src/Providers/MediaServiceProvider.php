<?php

namespace Collejo\App\Providers;

use Collejo\App\Contracts\Media\Uploader as UploaderInterface;
use Collejo\App\Foundation\Media\Uploader;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploaderInterface::class, function ($app) {
            return new Uploader();
        });
    }
}
