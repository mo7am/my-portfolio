<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Language extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'language',
        'description',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'language',
        'description',
    ];
}
