<?php

namespace Collejo\App\Http\Middleware;

use Closure;
use Request;

class Ajax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (!$request->ajax()) {
            abort(404);
        }

        return $next($request);
    }
}
