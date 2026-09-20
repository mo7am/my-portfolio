<?php

namespace App\Libraries;

use App\Models\Award;
use App\Support\Filters\AwardFilter;

class AwardLibrary extends AbstractLibrary
{
    protected string $model = Award::class;

    public function getAwardCount(array $filters = []): int
    {
        return $this->count(filter: new AwardFilter($filters));
    }
}
