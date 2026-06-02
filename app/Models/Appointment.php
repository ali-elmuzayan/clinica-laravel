<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use App\Enums\VisitType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

// fillable
#[Fillable('id', 'appointment_date', 'appointment_time', 'visit_type', 'expected_duration', 'status', 'notes', 'tenant_id', 'patient_id', 'doctor_id')]
class Appointment extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => AppointmentStatus::Scheduled,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'visit_type' => VisitType::class,
            'status' => AppointmentStatus::class,
        ];
    }

    // Relationships:
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
