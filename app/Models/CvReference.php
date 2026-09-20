<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class CvReference extends Model
{
    use BelongsToTenant, HasTranslations;

    protected $table = 'cv_references';

    /**
     * @var list<string>
     */
    public array $translatable = [
        'name',
        'position',
        'company',
    ];

    protected $fillable = [
        'tenant_id',
        'name',
        'position',
        'company',
        'email',
        'phone',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }
}
