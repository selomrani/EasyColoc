<?php

use App\Http\Middleware\accountStatusMiddleware;
use App\Http\Middleware\permissonMiddleware;
use App\Http\Middleware\routingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['routing' => routingMiddleware::class,
        'permission' => permissonMiddleware::class,
        'ban' => accountStatusMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
