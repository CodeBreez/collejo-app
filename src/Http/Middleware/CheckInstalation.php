<?php

namespace Collejo\App\Http\Middleware;

use Closure;
use Collejo\Core\Foundation\Application;

class CheckInstalation
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled()) {
            return view('collejo::setup.incomplete');
        }

        return $next($request);
    }

}
