<?php

namespace App\Libraries;

use App\Enums\LandingItemType;
use App\Models\LandingItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LandingItemLibrary extends AbstractLibrary
{
    protected string $model = LandingItem::class;

    public function queryByType(LandingItemType|string $type, bool $withoutGet = false): Builder|Collection
    {
        $builder = $this->resource->newQuery()
            ->ofType($type)
            ->ordered();

        return $withoutGet ? $builder : $builder->get();
    }

    public function nextSortOrder(LandingItemType|string $type): int
    {
        $max = (int) $this->resource->newQuery()->ofType($type)->max('sort_order');

        return $max + 1;
    }

    public function getByIdAndType(int $id, LandingItemType|string $type): Model
    {
        return $this->resource->newQuery()
            ->ofType($type)
            ->findOrFail($id);
    }
}
