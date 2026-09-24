<?php

namespace App\Libraries;

use App\Models\LandingFaq;

class LandingFaqLibrary extends AbstractLibrary
{
    protected string $model = LandingFaq::class;

    public function nextSortOrder(): int
    {
        return ((int) $this->resource->newQuery()->max('sort_order')) + 1;
    }
}
