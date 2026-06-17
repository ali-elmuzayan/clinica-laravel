<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request) {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
        // create the user 
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => Role::User,
        ]); 

        // create the tenant
        $tenant = Tenant::create([
            'name_ar' => $validated['tenant'], 
            'name_en' => $validated['tenant'], 
            'slug' => Str::slug($validated['tenant']),
            'subscription_type' => 'free_trail',
        ]);

        $user->tenant_id = $tenant->id;
        $user->save();

        // verify the user email
        event(new Registered($user));

        DB::commit();
        return response()->json([
            'message' => 'User created successfully',
        ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create user',
            ], 500);
        }
    }
}
