<?php

namespace App\Libraries;

use App\Models\Contact;
use App\Support\Filters\ContactFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactLibrary extends AbstractLibrary
{
    protected string $model = Contact::class;

    public function getContactList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new ContactFilter($filters),
            relations: $relations
        );
    }
}
