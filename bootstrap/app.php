<?php

use App\Http\Middleware\CheckTenantSetting;
use App\Http\Middleware\InitializeTenancyMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\MustBeAdminMiddleware;
use App\Http\Middleware\MustBeClientMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'admin' => MustBeAdminMiddleware::class,
            'client' => MustBeClientMiddleware::class,
            'Alert' => RealRashid\SweetAlert\Facades\Alert::class,
            'check.setting' => CheckTenantSetting::class,
        ]);
        $middleware->priority([
            \App\Http\Middleware\AttachTenantHeader::class,
            \App\Http\Middleware\InitializeTenancyMiddleware::class,
        ]);
    })
    ->withProviders([
        RealRashid\SweetAlert\SweetAlertServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
