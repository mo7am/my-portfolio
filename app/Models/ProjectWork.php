<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class ProjectWork extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'project_work',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'project_work',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
