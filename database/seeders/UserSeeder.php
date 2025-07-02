<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin IT',
            'email' => 'admin@it.com',
            'email_verified_at' => now(),
            'password' => 'admin',
            'role' => 'admin',

        ]);

        User::create([
            'name' => 'HRD',
            'email' => 'admin@hrd.com',
            'email_verified_at' => now(),
            'password' => 'admin',
            'role' => 'admin',

        ]);
    }
}
