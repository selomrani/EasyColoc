<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class permissonMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $userRole = Auth::user()->role->name;
        if($userRole != "admin"){
            abort(403);
        }
        return $next($request);
    }
}
