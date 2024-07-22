<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::factory(100)->create();
    }
}
