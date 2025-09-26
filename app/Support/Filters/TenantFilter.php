<?php

namespace App\Support\Filters;

use App\Models\Tenant;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TenantFilter extends AbstractFilter
{
    protected string $path = Tenant::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
