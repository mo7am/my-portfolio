<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Project extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'role',
        'description',
        'tags',
        'other',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'project_work_id',
        'title',
        'role',
        'type',
        'description',
        'date',
        'tags',
        'source_code',
        'website_url',
        'other',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function projectWork(): BelongsTo
    {
        return $this->belongsTo(ProjectWork::class);
    }
}
