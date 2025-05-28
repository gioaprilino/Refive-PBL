<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Position::create([
            'name' => 'HR Administrator',
            'department_id' => 1,
        ]);

        Position::create([
            'name' => 'IT Administrator',
            'department_id' => 2,
        ]);

        Position::create([
            'name' => 'Accounting Staff',
            'department_id' => 3,
        ]);
    }
}
