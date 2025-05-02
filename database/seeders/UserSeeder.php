<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'role' => 'admin',
            'password' => bcrypt('password'), // atau bcrypt('password')
        ]);

        // User biasa
        User::create([
            'name' => 'Customer User',
            'email' => 'user@example.com',
            'phone' => '082345678901',
            'address' => 'Jl. User No. 2',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        // Tambahan 10 user dummy
        User::factory()->count(10)->create();
    }
}
