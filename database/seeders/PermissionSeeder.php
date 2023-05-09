<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'create-role',
            'read-role',
            'update-role',
            'delete-role',
            'create-permission',
            'read-permission',
            'update-permission',
            'delete-permission',
            'create-category',
            'read-category',
            'update-category',
            'delete-category',
            'create-cake',
            'read-cake',
            'update-cake',
            'delete-cake'
        ];
        foreach ($permission as $key => $value) {
            Permission::create([
                'name' => $value
            ]);
        }
        $admin = Role::where('name', '=', 'admin')->first();
        $admin->syncPermissions($permission);
    }
}
