<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Experience extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'company',
        'location',
        'description',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'title',
        'company',
        'location',
        'employment_type',
        'description',
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
