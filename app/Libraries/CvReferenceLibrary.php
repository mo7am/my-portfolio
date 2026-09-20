<?php

namespace App\Libraries;

use App\Models\CvReference;
use App\Support\Filters\CvReferenceFilter;

class CvReferenceLibrary extends AbstractLibrary
{
    protected string $model = CvReference::class;

    public function getCvReferenceCount(array $filters = []): int
    {
        return $this->count(filter: new CvReferenceFilter($filters));
    }
}
