<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow admin login page without redirect
        if ($request->routeIs('admin.login', 'admin.login.check')) {
            return $next($request);
        }

        if (!session()->has('admin')) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
