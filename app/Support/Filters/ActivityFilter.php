<?php

namespace App\Support\Filters;

use App\Models\Activity;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ActivityFilter extends AbstractFilter
{
    protected string $path = Activity::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        if ($this->has('nullable_tenant')) {
            $builder->whereNull('tenant_id');
        }
        return $builder;
    }
}
