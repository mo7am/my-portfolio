<?php

namespace App\Libraries;

use App\Models\LandingTestimonial;

class LandingTestimonialLibrary extends AbstractLibrary
{
    protected string $model = LandingTestimonial::class;

    public function nextSortOrder(): int
    {
        return ((int) $this->resource->newQuery()->max('sort_order')) + 1;
    }
}
