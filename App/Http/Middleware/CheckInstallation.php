<?php

namespace Collejo\App\Http\Middleware;

use Closure;

class CheckInstallation
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled()) {
            return response(view('base::setup.incomplete'));
        }

        return $next($request);
    }
}
