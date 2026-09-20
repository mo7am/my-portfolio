<?php

namespace App\Support\Filters;

use App\Models\Course;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CourseFilter extends AbstractFilter
{
    protected string $path = Course::class;

    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
