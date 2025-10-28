<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AttemptSanctumAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $guard = 'sanctum'): Response {
        Auth::shouldUse($guard);
        if ($request->bearerToken()) {
            try {
                Auth::authenticate();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        return $next($request);
    }
}
