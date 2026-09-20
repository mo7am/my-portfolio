<?php

namespace App\Support\Filters;

use App\Models\CvReference;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CvReferenceFilter extends AbstractFilter
{
    protected string $path = CvReference::class;

    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
