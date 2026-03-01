<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class accountStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = Auth::user()->is_active;
        if (!$status) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            $error = "Your account is banned";
            return redirect()->route('login')->with('error', 'Your account is banned.');
        }
        return $next($request);
    }
}
