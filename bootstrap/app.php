<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use app\Http\Middleware\checkIfAdmin;
use App\Http\Middleware\CheckIfAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //         $middleware->alias([
        //     'checkIfAdmin' => CheckIfAdmin::class,
        // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
