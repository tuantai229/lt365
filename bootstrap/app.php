<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            RateLimiter::for('contact', function (Request $request) {
                return Limit::perMinute(5)->by($request->ip());
            });

            RateLimiter::for('newsletter', function (Request $request) {
                return Limit::perMinute(3)->by($request->ip());
            });

            RateLimiter::for('api', function (Request $request) {
                return Limit::perMinute(100)->by($request->user()?->id ?: $request->ip());
            });

            RateLimiter::for('search', function (Request $request) {
                return Limit::perMinute(30)->by($request->ip());
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
