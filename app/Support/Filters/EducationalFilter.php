<?php

namespace App\Support\Filters;

use App\Models\Educational;
use Illuminate\Contracts\Database\Eloquent\Builder;

class EducationalFilter extends AbstractFilter
{
    protected string $path = Educational::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
