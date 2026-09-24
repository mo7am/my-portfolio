<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    use HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'hero_eyebrow',
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'final_cta_title',
        'final_cta_subtitle',
        'final_cta_primary',
        'final_cta_secondary',
        'footer_tagline',
        'announcement_text',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'hero_eyebrow',
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'final_cta_title',
        'final_cta_subtitle',
        'final_cta_primary',
        'final_cta_secondary',
        'footer_tagline',
        'announcement_text',
        'announcement_enabled',
        'announcement_url',
        'contact_email',
        'contact_phone',
        'social_twitter',
        'social_linkedin',
        'social_github',
        'social_facebook',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'announcement_enabled' => 'boolean',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([]);
    }

    /**
     * @return array<string, string>
     */
    public function socialLinks(): array
    {
        return array_filter([
            'twitter' => $this->social_twitter,
            'linkedin' => $this->social_linkedin,
            'github' => $this->social_github,
            'facebook' => $this->social_facebook,
        ]);
    }

    public function hasAnnouncement(): bool
    {
        return $this->announcement_enabled
            && filled($this->getTranslation('announcement_text', null, true));
    }
}
