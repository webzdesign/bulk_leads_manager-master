<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withCommands([
        App\Console\Commands\LeadDelete::class,
        App\Console\Commands\LeadSend::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
       
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->dontReport([
           
        ]);
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);
        $exceptions->report(function (Throwable $e) {
        });
        

    })->create();
