<?php

namespace App\Support\Filters;

use App\Models\Website;
use Illuminate\Contracts\Database\Eloquent\Builder;

class WebsiteFilter extends AbstractFilter
{
    protected string $path = Website::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
