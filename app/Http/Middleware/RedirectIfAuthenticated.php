<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            if (!$request->expectsJson()) {
                if (Auth::guard($guard)->user()->role->name == 'merchant') {
                    return redirect()->route('merchant.dashboard.index');
                }

                if (Auth::guard($guard)->user()->role->name == 'customer') {
                    return $next($request);
                }
            }

            if (Auth::guard($guard)->user()->role->name == 'merchant') {
                return response()->json([
                    'message' => 'Unauthenticated.'
                ], 401);
            }
        }

        return $next($request);
    }
}
