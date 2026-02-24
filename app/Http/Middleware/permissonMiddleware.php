<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class permissonMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role)
        return $next($request);
    }
}
