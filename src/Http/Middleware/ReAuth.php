<?php

namespace Collejo\App\Http\Middleware;

use Closure;
use Auth;
use Session;

class ReAuth
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
        $token = Session::get('reauth-token');
        $ttl = config('collejo.auth.reauth_ttl');

        if (!is_null($ttl) && (is_null($token) 
            || ($token && $token['email'] != Auth::user()->email) 
            || ($token && $token['ts'] + $ttl < time()))) {

            if ($request->ajax()) {
                return response()->json([
                        'success' => false,
                        'data' => ['redir' => $request->getRequestUri()],
                        'message' => trans('auth::auth.reauth_expired')
                    ]);
            }

            return response(view('auth::reauth'));
        }

        return $next($request);
    }
}
