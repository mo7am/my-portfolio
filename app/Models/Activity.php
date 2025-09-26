<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'event',
        'causer_id',
        'causer_type',
        'properties',
        'tenant_id',
        'batch_uuid',
    ];
}
