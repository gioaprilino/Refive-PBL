<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    User::create([
    'name' => 'Admin IT',
    'email' => 'adminit@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin_it',]);

    User::create([
    'name' => 'Admin HRD',
    'email' => 'adminhrd@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin_hrd',]);

    User::create([
    'name' => 'HRD',
    'email' => 'hrd@example.com',
    'password' => bcrypt('password'),
    'role' => 'hrd',]);

    User::create([
    'name' => 'Staff',
    'email' => 'staff@example.com',
    'password' => bcrypt('password'),
    'role' => 'staff']);
    
    }    
}
