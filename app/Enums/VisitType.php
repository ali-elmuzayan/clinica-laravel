<?php

namespace App\Enums;

enum VisitType: string
{
    case Consultation = 'consultation';
    case FollowUp = 'follow_up';
    case Emergency = 'emergency';
    case RoutineCheck = 'routine_check';

    public function label(): string
    {
        return match ($this) {
            self::Consultation => 'Consultation',
            self::FollowUp => 'Follow Up',
            self::Emergency => 'Emergency',
            self::RoutineCheck => 'Routine Check',
        };
    }
}
