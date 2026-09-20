<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Educational extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'educational',
        'institution',
        'degree',
        'field',
        'location',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'educational',
        'institution',
        'degree',
        'field',
        'location',
        'gpa',
        'start_date',
        'end_date',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
