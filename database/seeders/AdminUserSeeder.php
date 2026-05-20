<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Do NOT use Hash::make() here — the 'hashed' cast in User model
        // hashes automatically. Double-hashing breaks login verification.
        User::updateOrCreate(
            ['email' => 'admin@aeternaio.com'],
            [
                'name'     => 'Admin',
                'password' => 'Admin@12345',
                'is_admin' => true,
            ]
        );
    }
}
