<?php

namespace App\Http\Middleware;

use App\Support\ContentLocale;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetContentLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isDashboardContext($request)) {
            // Independent CV content language for editing (sticky session + cookie).
            ContentLocale::bootstrapDefaultFromSystem();
            ContentLocale::set(ContentLocale::current());
        } else {
            // Public portfolio / PDF: follow visitor UI locale without changing dashboard CV language.
            ContentLocale::setForRequest(app()->getLocale());
        }

        return $next($request);
    }

    private function isDashboardContext(Request $request): bool
    {
        return $request->is('client')
            || $request->is('client/*')
            || $request->is('admin')
            || $request->is('admin/*');
    }
}
