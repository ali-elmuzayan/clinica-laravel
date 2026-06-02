<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
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
            'slug' => fake()->unique()->slug(),
            'subscription_type' => fake()->randomElement(['free_trail', 'basic', 'premium']),
            'subscription_expires_at' => fake()->dateTimeBetween('+1 month', '+3 months'),
        ];
    }
}
