<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    /**
     * Handle the event.
     */
    public function handle(Logout $event)
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
            ->log('You are logged out');
    }
}
