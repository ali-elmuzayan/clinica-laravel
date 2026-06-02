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
            'id' => fake()->uuid(),
            'name_ar' => fake()->name('ar_SA'),
            'name_en' => fake()->name('en_US'),
            'slug' => fake()->slug(),
            'subscription_type' => fake()->randomElement(['free_trail', 'basic', 'premium']),
            // 'subscription_expires_at' => fake()->dateTimeInInterval('+1 month', '+3 months'),
            'data' => json_encode([]),
        ];
    }
}
