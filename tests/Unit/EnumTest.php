<?php

use App\Enums\AppointmentStatus;
use App\Enums\Role;
use App\Enums\VisitType;

it('defines all role cases with labels', function () {
    expect(Role::cases())->toHaveCount(4)
        ->and(Role::Admin->value)->toBe('admin')
        ->and(Role::Admin->label())->toBe('Admin')
        ->and(Role::SuperAdmin->value)->toBe('super_admin');
});

it('defines all visit type cases with labels', function () {
    expect(VisitType::cases())->toHaveCount(4)
        ->and(VisitType::Consultation->value)->toBe('consultation')
        ->and(VisitType::FollowUp->label())->toBe('Follow Up');
});

it('defines all appointment status cases with labels', function () {
    expect(AppointmentStatus::cases())->toHaveCount(3)
        ->and(AppointmentStatus::Scheduled->value)->toBe('scheduled')
        ->and(AppointmentStatus::Cancelled->label())->toBe('Cancelled');
});
