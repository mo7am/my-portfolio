<?php

use App\Http\Middleware\AttachTenantHeader;
use App\Http\Middleware\CheckTenantSetting;
use App\Http\Middleware\InitializeTenancyMiddleware;
use App\Http\Middleware\MustBeAdminMiddleware;
use App\Http\Middleware\MustBeClientMiddleware;
use App\Http\Middleware\SetContentLocale;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            SetLocale::class,
            SetContentLocale::class,
        ]);

        $middleware->alias([
            'admin' => MustBeAdminMiddleware::class,
            'client' => MustBeClientMiddleware::class,
            'Alert' => Alert::class,
            'check.setting' => CheckTenantSetting::class,
        ]);
        $middleware->priority([
            AttachTenantHeader::class,
            InitializeTenancyMiddleware::class,
        ]);
    })
    ->withProviders([
        SweetAlertServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
