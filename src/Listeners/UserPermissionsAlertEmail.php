<?php

namespace Collejo\App\Listeners;

use Collejo\App\Events\UserPermissionsChanged;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPermissionsAlertEmail implements ShouldQueue
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
     * @param UserPermissionsChanged $event
     *
     * @return void
     */
    public function handle(UserPermissionsChanged $event)
    {
        // email all users
    }
}
