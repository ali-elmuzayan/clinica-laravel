<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Enums\VisitType;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tenant = Tenant::factory()->create();

        return [
            'appointment_date' => fake()->dateTimeBetween('+1 day', '+1 month')->format('Y-m-d'),
            'appointment_time' => fake()->time('H:i'),
            'visit_type' => fake()->randomElement(VisitType::cases()),
            'expected_duration' => fake()->numberBetween(15, 120),
            'status' => AppointmentStatus::Scheduled,
            'notes' => fake()->optional()->sentence(),
            'tenant_id' => $tenant->id,
            'patient_id' => Patient::factory()->create(['tenant_id' => $tenant->id])->id,
            'doctor_id' => User::factory()->doctor()->create(['tenant_id' => $tenant->id])->id,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => AppointmentStatus::Completed,
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => AppointmentStatus::Cancelled,
        ]);
    }
}
