<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->assignRole('user'),
            'full_name' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city(),
            'gender' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}
