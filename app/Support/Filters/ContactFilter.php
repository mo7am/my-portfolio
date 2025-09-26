<?php

namespace App\Support\Filters;

use App\Models\Contact;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ContactFilter extends AbstractFilter
{
    protected string $path = Contact::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
