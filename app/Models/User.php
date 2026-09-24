<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use BelongsToTenant, HasApiTokens, HasFactory, HasTranslations, InteractsWithMedia, Notifiable;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'first_name',
        'second_name',
        'third_name',
        'address',
        'nationality',
        'objective',
        'job_title',
        'job_description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'first_name',
        'second_name',
        'third_name',
        'email',
        'password',
        'phone',
        'address',
        'birthdate',
        'nationality',
        'marital_status',
        'objective',
        'domain',
        'job_title',
        'job_description',
        'cv_drive_link',
        'cv_drive_file_id',
        'type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthdate' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->useFallbackUrl(config('app.url').'/logos/logo.png')
            ->useFallbackPath(public_path('logos/logo.png'))
            ->useDisk('users');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => trim(implode(' ', array_filter([
                $this->first_name,
                $this->second_name,
                $this->third_name,
            ])))
        );
    }

    public function getPortfolioLinkAttribute()
    {
        return config('app.url').'/'.$this->domain;
    }
}
