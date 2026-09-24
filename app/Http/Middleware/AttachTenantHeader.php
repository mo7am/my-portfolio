<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use App\Libraries\UserLibrary;
use App\Support\Filters\UserFilter;
use Closure;
use Illuminate\Http\Request;

class AttachTenantHeader
{
    /**
     * Path prefixes that must never be treated as portfolio domain slugs.
     *
     * @var list<string>
     */
    protected array $reservedSegments = [
        'login',
        'register',
        'logout',
        'password',
        'locale',
        'content-locale',
        'drive',
        'admin',
        'client',
        'assets',
        'storage',
        'sanctum',
        'up',
        'api',
    ];

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
            'landing',
            'register',
            'login',
            'password.request',
            'password.email',
            'password.reset',
            'password.store',
            'locale.switch',
            'content-locale.switch',
            'drive.oauth.redirect',
            'drive.oauth.callback',
        ])) {
            return $next($request);
        }

        if (auth('sanctum')->check() && auth('sanctum')->user()->type === UserType::CLIENT->value) {
            $request->headers->set('X-Tenant', auth('sanctum')->user()->tenant_id);

            return $next($request);
        }

        if (
            (auth('sanctum')->check() && auth('sanctum')->user()->type === UserType::ADMIN->value)
            || ! auth('sanctum')->check()
        ) {
            $domainSlug = $request->segment(1);

            if (! filled($domainSlug) || in_array($domainSlug, $this->reservedSegments, true)) {
                return $next($request);
            }

            $user = app(UserLibrary::class)->first(new UserFilter(['domain' => $domainSlug]));

            if (! $user) {
                if (! auth('sanctum')->check()) {
                    // Unknown public portfolio URL — marketing home, no auth flash.
                    return redirect()->route('landing');
                }

                if (auth('sanctum')->user()->type === UserType::ADMIN->value) {
                    return redirect()->route('admins.index');
                }

                return $next($request);
            }

            $request->headers->set('X-Tenant', $user->tenant_id);
        }

        return $next($request);
    }
}
