<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Volunteering extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'organization',
        'role',
        'description',
    ];

    protected $fillable = [
        'tenant_id',
        'organization',
        'role',
        'start_date',
        'end_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
