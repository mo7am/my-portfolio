<?php

namespace App\Libraries;

use App\Models\Course;
use App\Support\Filters\CourseFilter;

class CourseLibrary extends AbstractLibrary
{
    protected string $model = Course::class;

    public function getCourseCount(array $filters = []): int
    {
        return $this->count(filter: new CourseFilter($filters));
    }
}
