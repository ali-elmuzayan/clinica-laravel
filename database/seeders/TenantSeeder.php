<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Tenant;
use App\Models\Appointment;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tenants = Tenant::all();
        $tenants->map(function ($tenant) {
            $patients = Patient::factory(100)->create([
                'tenant_id' => $tenant->id,
            ]);

            $patients->each(function ($patient) use ($tenant) {
                $appointments = Appointment::factory(100)->create([
                    'tenant_id' => $patient->tenant_id,
                    'patient_id' => $patient->id,
                    'doctor_id' => $tenant->users()->inRandomOrder()->first()->id,
                ]);
            });

        });
    }
}
