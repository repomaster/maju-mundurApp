<?php

namespace App\Http\Middleware;

use Closure;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role->name != 'merchant') {
            if (!$request->expectsJson()) {
                return redirect()->route('login');
            }

            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        return $next($request);
    }
}
