<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Website extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'name',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'url',
    ];
}
