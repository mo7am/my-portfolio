<?php

namespace App\Support\Filters;

use App\Models\Volunteering;
use Illuminate\Contracts\Database\Eloquent\Builder;

class VolunteeringFilter extends AbstractFilter
{
    protected string $path = Volunteering::class;

    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
