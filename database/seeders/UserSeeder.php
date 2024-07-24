<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        User::query()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('user');
    }
}
