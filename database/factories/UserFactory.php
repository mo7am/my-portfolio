<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'second_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'type' => UserType::CLIENT->value,
            'status' => Status::ACTIVE->value,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'domain' => fake()->unique()->slug(2),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
