<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\AccessLevels;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test user (optional)
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'access_level' => AccessLevels::USER,
        ]);

        // Admin user
        User::create([
            'name'         => 'Admin',
            'email'        => 'admin@example.com',
            'password'     => Hash::make('admin123'),
            'access_level' => AccessLevels::ADMIN,
        ]);
    }
}
