<?php

use App\Enums\AppointmentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('visit_type');
            $table->unsignedInteger('expected_duration')->nullable();
            $table->string('status')->default(AppointmentStatus::Scheduled->value)->index();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreignUuid('tenant_id')->nullable()->constrained('tenants');
            $table->foreignUuid('patient_id')->constrained('patients');
            $table->foreignUuid('doctor_id')->constrained('users');

            $table->index('appointment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
