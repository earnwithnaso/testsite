<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@earnwithnazo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create regular test user
        User::create([
            'name' => 'Test User',
            'email' => 'user@earnwithnazo.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
