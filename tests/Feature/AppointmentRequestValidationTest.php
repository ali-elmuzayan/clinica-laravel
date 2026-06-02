<?php

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

it('rejects invalid visit type when storing an appointment', function () {
    $validator = Validator::make([
        'appointment_date' => '2026-06-15',
        'appointment_time' => '10:00',
        'visit_type' => 'invalid',
        'patient_id' => Str::uuid()->toString(),
        'doctor_id' => Str::uuid()->toString(),
    ], (new StoreAppointmentRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('visit_type'))->toBeTrue();
});

it('rejects invalid appointment status when storing an appointment', function () {
    $validator = Validator::make([
        'appointment_date' => '2026-06-15',
        'appointment_time' => '10:00',
        'visit_type' => 'consultation',
        'status' => 'invalid',
        'patient_id' => Str::uuid()->toString(),
        'doctor_id' => Str::uuid()->toString(),
    ], (new StoreAppointmentRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('status'))->toBeTrue();
});

it('accepts valid enum values when storing an appointment', function () {
    $patient = Patient::factory()->create();
    $doctor = User::factory()->doctor()->create(['tenant_id' => $patient->tenant_id]);

    $validator = Validator::make([
        'appointment_date' => '2026-06-15',
        'appointment_time' => '10:00',
        'visit_type' => 'follow_up',
        'status' => 'scheduled',
        'patient_id' => $patient->id,
        'doctor_id' => $doctor->id,
    ], (new StoreAppointmentRequest)->rules());

    expect($validator->fails())->toBeFalse();
});

it('rejects invalid visit type when updating an appointment', function () {
    $validator = Validator::make([
        'visit_type' => 'not_a_visit_type',
    ], (new UpdateAppointmentRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('visit_type'))->toBeTrue();
});

it('rejects invalid appointment status when updating an appointment', function () {
    $validator = Validator::make([
        'status' => 'not_a_status',
    ], (new UpdateAppointmentRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('status'))->toBeTrue();
});
