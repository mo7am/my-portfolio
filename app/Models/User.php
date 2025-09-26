<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, BelongsToTenant, HasApiTokens, InteractsWithMedia;

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
            ->useFallbackUrl(config('app.url') . '/logos/logo.png')
            ->useFallbackPath(public_path('logos/logo.png'))
            ->useDisk('users');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value = null, array $attributes = []) => sprintf('%s %s %s', Arr::get($attributes, 'first_name'), Arr::get($attributes, 'second_name'), Arr::get($attributes, 'third_name'))
        );
    }

    public function getPortfolioLinkAttribute()
    {
        return config('app.url').'/'.$this->domain;
    }
}
