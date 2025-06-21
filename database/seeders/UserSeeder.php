<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'role' => 'admin'

        ]);

        User::create([
            'name' => 'HRD',
            'email' => 'admin@hrd.com',
            'email_verified_at' => now(),
            'password' => 'admin',
            'role' => 'hrd'

        ]);
    }
}
