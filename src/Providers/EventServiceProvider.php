<?php

namespace Collejo\App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Collejo\App\Events\UserPermissionsChanged' => [
            'Collejo\App\Listeners\ClearUserPermissionsCache',
        ],
        'Collejo\App\Events\UserCreated' => [
            'Collejo\App\Listeners\SendPasswordCreateRequestEmail',
        ],
        'Collejo\App\Events\CriteriaDataChanged' => [
            'Collejo\App\Listeners\ClearCriteriaCache',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
