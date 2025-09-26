<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Project extends Model
{
    use BelongsToTenant;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'project_work_id',
        'title',
        'description',
        'date',
        'tags',
        'source_code',
        'website_url',
        'other',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'tags' => 'array',
        ];
    }

    public function projectWork(): BelongsTo
    {
        return $this->belongsTo(ProjectWork::class);
    }
}