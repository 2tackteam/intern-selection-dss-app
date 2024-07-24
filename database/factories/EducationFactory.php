<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application_id' => Application::factory()->create(),
            'education_level' => $this->faker->randomElement(['SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1']),
            'institution_name' => $this->faker->company,
            'major' => $this->faker->randomElement(['Teknik Komputer Jaringan', 'Administrasi Perkantoran', 'Akuntansi', 'Otomatisasi dan Tata Kelola Perkantoran', 'Bisnis & Manajemen', 'Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika', 'Pengembangan Masyarakat Islam', 'Ilmu pemerintahan', 'Administrasi Publik']),
            'start_year' => $this->faker->year,
            'end_year' => $this->faker->year,
            'gpa' => $this->faker->randomFloat(2, 60, 100),
        ];
    }
}
