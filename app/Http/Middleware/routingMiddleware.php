<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class routingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role->name;

            if ($userRole == "admin" && !$request->is('admin*')) {
                return redirect('/admin');
            }

            if ($userRole !== "admin" && !$request->is('dashboard')) {
                return redirect('/dashboard');
            }
        }
        return $next($request);
    }
}
