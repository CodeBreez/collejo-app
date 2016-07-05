<?php

namespace Collejo\App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon;

class SetUserTime
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
        $userTime = $request->header('X-User-Time');

        if (!is_null($userTime)) {
            
            $time = Carbon::parse(substr($userTime, 0, 34));

            Session::put('user-tz', $time->timezoneName);
        }

        return $next($request);
    }
}
