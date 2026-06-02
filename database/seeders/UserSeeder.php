<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::factory(100)->create();
        $users->map(function ($user) {
            $tenant = Tenant::factory()->create();
            $user->tenant_id = $tenant->id;
            $user->save();
        });
    }
}
