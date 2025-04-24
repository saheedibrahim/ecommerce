<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request) // Response
    {
        if (!$request->expectsJson()) {
            if ($request->routeIs('admin.*')) {
                Session::flash('fail', 'You must login first');
                return route('admin.login');
            }
            
            if ($request->routeIs('seller.*')) {
                Session::flash('fail', 'You must login first');
                return route('seller.login');
            }
        }
        // return $next($request);
    }
}
