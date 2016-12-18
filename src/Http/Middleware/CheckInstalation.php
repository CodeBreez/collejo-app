<?php

namespace Collejo\App\Http\Middleware;

use Closure;
use Collejo\App\Foundation\Application;

class CheckInstalation
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled() && !env('MULTI_TENANT_MODE')) {
            return view('collejo::setup.incomplete');
        }

        return $next($request);
    }

}
