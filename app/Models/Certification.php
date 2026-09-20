<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Certification extends Model
{
    use BelongsToTenant, HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'issuer',
    ];

    protected $fillable = [
        'tenant_id',
        'title',
        'issuer',
        'issued_at',
        'expires_at',
        'credential_id',
        'url',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }
}
