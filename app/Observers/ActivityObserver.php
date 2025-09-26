<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ActivityObserver
{
    public function created(Model $model)
    {
        $user = auth('sanctum')->user();
        activity()
            ->performedOn($model)
            ->causedBy($user)
            ->tap(function ($activity) use ($user) {
                $activity->tenant_id = $user->tenant_id ?? null;
            })
            ->withProperties([
                'attributes' => $model->getAttributes(),
                'route' => request()->path(),
                'ip' => request()->ip(),
                'ua' => request()->userAgent(),
            ])
            ->log(class_basename($model).' created');
    }

    public function updated(Model $model)
    {
        $user = auth('sanctum')->user();
        activity()
            ->performedOn($model)
            ->causedBy($user)
            ->tap(function ($activity) use ($user) {
                $activity->tenant_id = $user->tenant_id ?? null;
            })
            ->withProperties([
                'old' => $model->getOriginal(),
                'attributes' => $model->getAttributes(),
                'changed' => $model->getChanges(),
                'route' => request()->path(),
                'ip' => request()->ip(),
                'ua' => request()->userAgent(),
            ])
            ->log(class_basename($model).' updated');
    }

    public function deleted(Model $model)
    {
        $user = auth('sanctum')->user();
        activity()
            ->performedOn($model)
            ->causedBy($user)
            ->tap(function ($activity) use ($user) {
                $activity->tenant_id = $user->tenant_id ?? null;
            })
            ->withProperties([
                'attributes' => $model->getAttributes(),
                'tenant_id' => $user->tenant_id ?? null,
                'route' => request()->path(),
                'ip' => request()->ip(),
                'ua' => request()->userAgent(),
            ])
            ->log(class_basename($model).' deleted');
    }
}
