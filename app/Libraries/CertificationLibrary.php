<?php

namespace App\Libraries;

use App\Models\Certification;
use App\Support\Filters\CertificationFilter;

class CertificationLibrary extends AbstractLibrary
{
    protected string $model = Certification::class;

    public function getCertificationCount(array $filters = []): int
    {
        return $this->count(filter: new CertificationFilter($filters));
    }
}
