<?php

namespace App\Support\Filters;

use App\Models\Certification;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CertificationFilter extends AbstractFilter
{
    protected string $path = Certification::class;

    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
