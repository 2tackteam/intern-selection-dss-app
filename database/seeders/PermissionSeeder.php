<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view-menu dashboard',
            'view-menu manage-applicant',
            'view-menu applicant',
            'view-menu profile',

            'view applicants',
            'create applicants',
            'update applicants',
            'delete applicants',

            'update profile',
            'update password',
            'delete account',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => "$permission"]);
        }

        Role::create(['name' => 'admin'])->givePermissionTo($permissions);
        Role::create(['name' => 'user'])->syncPermissions([
            'view-menu dashboard',
            'view-menu applicant',
            'view-menu profile',

            'view applicants',
            'create applicants',

            'update profile',
            'update password',
            'delete account',
        ]);
    }
}
