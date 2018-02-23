<?php

namespace Collejo\App\Http\Middleware;

use Closure;

class CheckInstallation
{
    /**
     * Determines if Collejo is installed
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!app()->isInstalled()) {
            return response(view('base::setup.incomplete'));
        }

        return $next($request);
    }
}
