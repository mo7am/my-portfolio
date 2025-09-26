<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'first_name' => 'Admin',
            'third_name' => 'User',
            'email' => 'admin@portfolio.com',
            'password' => bcrypt('password'),
            'type' => UserType::ADMIN->value,
        ]);
    }
}
