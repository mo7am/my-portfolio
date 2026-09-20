<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'is_default',
        'is_show_educational',
        'is_show_experience',
        'is_show_language',
        'is_show_skill',
        'is_show_project',
        'is_show_link',
        'is_show_contact',
        'is_show_download_cv',
        'is_show_website',
        'is_show_certification',
        'is_show_course',
        'is_show_award',
        'is_show_volunteering',
        'is_show_reference',
    ];

    protected $casts = [
        'is_show_educational' => 'boolean',
        'is_show_experience' => 'boolean',
        'is_show_language' => 'boolean',
        'is_show_skill' => 'boolean',
        'is_show_project' => 'boolean',
        'is_show_link' => 'boolean',
        'is_show_contact' => 'boolean',
        'is_default' => 'boolean',
        'is_show_download_cv' => 'boolean',
        'is_show_website' => 'boolean',
        'is_show_certification' => 'boolean',
        'is_show_course' => 'boolean',
        'is_show_award' => 'boolean',
        'is_show_volunteering' => 'boolean',
        'is_show_reference' => 'boolean',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'name',
            'is_default',
            'is_show_educational',
            'is_show_experience',
            'is_show_language',
            'is_show_skill',
            'is_show_project',
            'is_show_link',
            'is_show_contact',
            'is_show_download_cv',
            'is_show_website',
            'is_show_certification',
            'is_show_course',
            'is_show_award',
            'is_show_volunteering',
            'is_show_reference',
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'tenant_id', 'id');
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class, 'tenant_id', 'id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'tenant_id', 'id');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(Language::class, 'tenant_id', 'id');
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class, 'tenant_id', 'id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'tenant_id', 'id');
    }

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class, 'tenant_id', 'id');
    }

    public function volunteerings(): HasMany
    {
        return $this->hasMany(Volunteering::class, 'tenant_id', 'id');
    }

    public function cvReferences(): HasMany
    {
        return $this->hasMany(CvReference::class, 'tenant_id', 'id');
    }
}
