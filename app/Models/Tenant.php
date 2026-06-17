<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

#[Fillable(['id', 'name_ar', 'name_en', 'slug', 'subscription_type', 'subscription_expires_at', 'data', 'created_by'])]
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'subscription_expires_at' => 'date',
        ];
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name_ar',
            'name_en',
            'slug',
            'subscription_type',
            'subscription_expires_at',
            'created_at',
            'updated_at',
        ];
    }


    // Relationships:
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
