<?php

namespace App\Libraries;

use App\Models\Website;
use App\Support\Filters\WebsiteFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class WebsiteLibrary extends AbstractLibrary
{
    protected string $model = Website::class;

    public function getWebsiteList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new WebsiteFilter($filters),
            relations: $relations
        );
    }

    public function getWebsiteCount(array $filters = []): int
    {
        return $this->count(
            filter: new WebsiteFilter($filters),
        );
    }
}
