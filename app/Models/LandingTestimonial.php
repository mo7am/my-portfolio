<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use App\Models\Concerns\Publishable;
use App\Models\Concerns\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LandingTestimonial extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, Publishable, Sortable;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'quote',
        'name',
        'role',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'quote',
        'name',
        'role',
        'sort_order',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->useDisk('landing');
    }

    public function photoUrl(): ?string
    {
        return $this->getFirstMediaUrl('photo') ?: null;
    }
}
