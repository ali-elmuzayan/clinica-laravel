<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use App\Enums\VisitType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
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
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'visit_type' => ['required', Rule::enum(VisitType::class)],
            'expected_duration' => ['nullable', 'integer', 'min:1'],
            'status' => ['sometimes', Rule::enum(AppointmentStatus::class)],
            'notes' => ['nullable', 'string'],
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'doctor_id' => ['required', 'uuid', 'exists:users,id'],
        ];
    }
}
