<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatusEnum;
use App\Enums\EducationLevelEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(public_path('json/sample_data.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $user = User::query()->create([
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            $user->assignRole('user');

            // Store Applications
            $application = $user->applications()->create([
                'full_name' => $item['name'],
                'birth_place' => fake()->city,
                'birth_date' => fake()->date('Y-m-d', now()->subYears(5)),
                'gender'=> $item['gender'],
                'status'=> ApplicationStatusEnum::PENDING->value,
            ]);

            $educationLevel = $item['education_level'];
            $total = $educationLevel === EducationLevelEnum::SHS_VHS->value ? 3 : 4;
            $startYear = (int) fake()->year(now()->subYears(5));
            $endYear = $startYear + $total;

            // Store Education
            $application->education()->create([
                'education_level' => $educationLevel,
                'institution_name' => $item['institution_name'],
                'major' => $item['major'],
                'start_year' => $startYear,
                'end_year' => $endYear,
                'gpa' => $item['gpa'],
            ]);
        }
    }
}
