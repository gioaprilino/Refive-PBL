<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Department::create(['code' => 'HRD', 'name' => 'Human Resource Management']);
        Department::create(['code' => 'IT', 'name' => 'Information Technology']);
        Department::create(['code' => 'FIN', 'name' => 'Finance']);
    }
}
