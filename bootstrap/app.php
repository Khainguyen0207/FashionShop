<?php

use App\Http\Middleware\CheckAuth;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckRoleAccess;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'CheckRoleAccess' => CheckRoleAccess::class,
                'CheckAuth' => CheckAuth::class,
            ]
        );
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command("php artisan storage:link")->everyFiveSeconds();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
