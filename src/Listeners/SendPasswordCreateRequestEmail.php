<?php

namespace Collejo\App\Listeners;

use Collejo\App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordCreateRequestEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param UserCreated $event
     *
     * @return void
     */
    public function handle(UserCreated $event)
    {
        if ($event->user->roles) {
            // code...
        }
    }
}
