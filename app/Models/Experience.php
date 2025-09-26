<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Experience extends Model
{
    use BelongsToTenant;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'start_date',
        'end_date',
    ];

     /**
     * Get the attributes that should be cast.
     *
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
