<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '08123456789',
            'gender' => 'Male',
            'address' => '123 Main St, Springfield',
            'department_id' => 1,
            'position_id' => 1,
            'hire_date' => '2023-01-01',
            'status' => 'active',
        ]);
    }
}
