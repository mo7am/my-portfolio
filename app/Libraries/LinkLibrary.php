<?php

namespace App\Libraries;

use App\Models\Link;
use App\Support\Filters\LinkFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class LinkLibrary extends AbstractLibrary
{
    protected string $model = Link::class;

    public function getEducationalList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new LinkFilter($filters),
            relations: $relations
        );
    }

    public function getLinkCount(array $filters = []): int
    {
        return $this->count(
            filter: new LinkFilter($filters),
        );
    }
}
