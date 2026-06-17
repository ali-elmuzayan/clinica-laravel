<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => fake()->name(),
            'name_en' => fake()->name(),
            'age' => fake()->numberBetween(1, 100),
            'gender' => fake()->randomElement(['male', 'female']),
            'nationality' => fake()->country(),
            'birth_date' => fake()->date(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'symptoms' => fake()->text(),
            'tenant_id' => Tenant::factory()->create()->id,
        ];
    }
}
