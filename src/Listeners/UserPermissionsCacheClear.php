<?php 

namespace Collejo\App\Listeners;

use Collejo\App\Events\UserPermissionsChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;

class UserPermissionsCacheClear implements ShouldQueue{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Handle the event.
     *
     * @param  UserPermissionsChanged  $event
     * @return void
     */
    public function handle(UserPermissionsChanged $event)
    {
        return Cache::forget('user-perms-' . $event->user->id);
    }
}