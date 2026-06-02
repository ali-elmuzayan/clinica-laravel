<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Doctor = 'doctor';
    case Receptionist = 'receptionist';
    case SuperAdmin = 'super_admin';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Doctor => 'Doctor',
            self::Receptionist => 'Receptionist',
            self::SuperAdmin => 'Super Admin',
        };
    }
}
