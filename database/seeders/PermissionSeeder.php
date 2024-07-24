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
            'view-menu internship-applicants',
            'view-menu internship-applicant-selections',
            'view-menu internship-applicant-selection-results',
            'view-menu application-submissions',
            'view-menu profile',

            'view internship-applicants',
            'print internship-applicants',

            'selection internship-applicant-selections',
            'process-selection internship-applicant-selections',
            'result internship-applicant-selections',
            'process-result internship-applicant-selections',

            'view internship-applicant-selection-results',
            'print internship-applicant-selection-results',

            'view applications',
            'create applications',
            'print applications',

            'update profile',
            'update password',
            'delete account',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => "$permission"]);
        }

        Role::create(['name' => 'admin'])->syncPermissions([
            'view-menu dashboard',
            'view-menu internship-applicants',
            'view-menu internship-applicant-selections',
            'view-menu internship-applicant-selection-results',
            'view-menu profile',

            'view internship-applicants',
            'print internship-applicants',

            'selection internship-applicant-selections',
            'process-selection internship-applicant-selections',
            'result internship-applicant-selections',
            'process-result internship-applicant-selections',

            'view internship-applicant-selection-results',
            'print internship-applicant-selection-results',

            'update profile',
            'update password',
            'delete account',
        ]);

        Role::create(['name' => 'user'])->syncPermissions([
            'view-menu dashboard',
            'view-menu application-submissions',
            'view-menu profile',

            'view applications',
            'create applications',
            'print applications',

            'update profile',
            'update password',
            'delete account',
        ]);
    }
}
