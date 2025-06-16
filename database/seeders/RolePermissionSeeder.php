<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonies',
            'manage clients',
            'manage teams',
            'manage about',
            'manage contacts',
            'manage hero sections',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]);
        }

        $superAdminRole = Role::firstOrCreate(
            [
                'name' => 'super_admin'
            ]
        );

        

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
        ]);

        $designManagerRole = Role::firstOrCreate(
            [
                'name' => 'design_manager'
            ]
        );

        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonies',
           
        ];

        $designManagerRole->syncPermissions($designManagerPermissions);

        $user->assignRole($superAdminRole);
        $user->assignRole($superAdminRole);
        $user->assignRole($designManagerRole);
    }
}
