<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class LogSuccessfulLogin
{
     /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        if ($user instanceof Authenticatable && ! $user instanceof Model) {
            $user = \App\Models\User::find($user->getAuthIdentifier());
        }
        activity()
            ->causedBy($user)
            ->tap(function ($activity) use ($user) {
                $activity->tenant_id = $user->tenant_id ?? null;
            })
            ->withProperties([
                'ip'        => request()->ip(),
                'ua'        => request()->userAgent(),
                'route'     => request()->path(),
            ])
            ->log('You are logged in');
    }
}
