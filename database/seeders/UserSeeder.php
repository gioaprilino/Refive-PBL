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
            'name' => 'Admin',
            'email' => 'admin@tvn.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'role' => 'admin',

        ]);

        User::create([
            'name' => 'HRD',
            'email' => 'hrd@tvn.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'role' => 'hrd',

        ]);
    }
}
