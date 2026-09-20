<?php

namespace App\Libraries;

use App\Models\Volunteering;
use App\Support\Filters\VolunteeringFilter;

class VolunteeringLibrary extends AbstractLibrary
{
    protected string $model = Volunteering::class;

    public function getVolunteeringCount(array $filters = []): int
    {
        return $this->count(filter: new VolunteeringFilter($filters));
    }
}
