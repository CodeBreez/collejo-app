<?php

namespace Collejo\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Request;

class CheckInstalation
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled() && !str_is('setup*', Request::path())) {
            return redirect('/setup');
        }

        return $next($request);
    }
}
