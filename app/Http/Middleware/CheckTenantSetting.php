<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenantSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $setting)
    {
        $tenant = tenant();
        if (! $tenant || ! $tenant->$setting) {
            abort(404);
        }
        return $next($request);
    }
}
