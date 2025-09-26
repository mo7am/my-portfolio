<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use App\Libraries\UserLibrary;
use App\Models\Tenant;
use App\Support\Filters\UserFilter;
use Closure;
use Illuminate\Http\Request;

class AttachTenantHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs('admins.*')) {
            return $next($request);
        }
        if ($request->routeIs([
            'register',
            'login',
            'password.request',
            'password.email',
            'password.reset',
            'password.store',
        ])) {
            return $next($request);
        }
        if (auth('sanctum')->check() && auth('sanctum')->user()->type === UserType::CLIENT->value) {
            $tenantId = auth('sanctum')->user()->tenant_id;
            $request->headers->set('X-Tenant', $tenantId);
        } else if ((auth('sanctum')->check() && auth('sanctum')->user()->type === UserType::ADMIN->value) || !auth('sanctum')->check()) {
            $segments = $request->segments(); 
            $domainSlug = $segments[0];
            $user = app(UserLibrary::class)->first(new UserFilter(['domain' => $domainSlug]));
        
            if (! $user) {
                if (!auth('sanctum')->check()) {
                    return redirect()->route('register')->with('error', 'Please sign-up to portfolio and start the adventure to get your portfolio website.');
                } else {
                    if (auth('sanctum')->user()->type === UserType::ADMIN->value) {
                        return redirect()->route('admins.index');
                    }
        
                    return $next($request);
                }
            }
        
            $request->headers->set('X-Tenant', $user->tenant_id);
        }

        return $next($request);
    }
}
