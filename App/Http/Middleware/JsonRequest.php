<?php

namespace Collejo\App\Http\Middleware;

use Closure;

class JsonRequest
{
    const PARSED_METHODS = [
        'POST', 'PUT', 'PATCH',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (in_array($request->getMethod(), self::PARSED_METHODS)) {
            $request->merge((array) json_decode($request->getContent()));
        }

        return $next($request);
    }
}
