<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyMiddleware extends InitializeTenancyByRequestData
{
    public function handle($request, Closure $next): Response
    {
        // dd(123);
        if (
            $request->is('assets/*') ||
            $request->is('css/*') ||
            $request->is('js/*') ||
            $request->is('images/*') ||
            $request->is('fonts/*')
        ) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
