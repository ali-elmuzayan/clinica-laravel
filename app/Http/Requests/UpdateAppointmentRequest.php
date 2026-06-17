<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use App\Enums\VisitType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_date' => ['sometimes', 'date'],
            'appointment_time' => ['sometimes', 'date_format:H:i'],
            'visit_type' => ['sometimes', Rule::enum(VisitType::class)],
            'expected_duration' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'status' => ['sometimes', Rule::enum(AppointmentStatus::class)],
            'notes' => ['sometimes', 'nullable', 'string'],
            'patient_id' => ['sometimes', 'uuid', 'exists:patients,id'],
            'doctor_id' => ['sometimes', 'uuid', 'exists:users,id'],
        ];
    }
}
