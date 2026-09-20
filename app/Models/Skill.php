<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Skill extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'skill',
        'level',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'skill',
        'level',
        'category',
    ];
}
