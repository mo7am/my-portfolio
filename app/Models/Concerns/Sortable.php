<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    public function scopeOrdered(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy($this->getTable().'.sort_order', $direction)
            ->orderBy($this->getTable().'.id', $direction);
    }
}
