<?php

namespace App\Support\Filters;

use App\Models\Experience;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ExperienceFilter extends AbstractFilter
{
    protected string $path = Experience::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
