<?php

namespace Collejo\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckInstalation
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled()) {
            return redirect('/setup');
        }

        return $next($request);
    }
}
