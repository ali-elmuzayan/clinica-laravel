<?php

use App\Enums\AppointmentStatus;
use App\Enums\Role;
use App\Enums\VisitType;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

it('allows users with an allowed role through the middleware', function (Role $role) {
    $user = User::factory()->create(['role' => $role]);

    $request = Request::create('/api/v1/tenants', 'GET');
    $request->setUserResolver(fn () => $user);

    $middleware = new RoleMiddleware;

    $response = $middleware->handle($request, fn () => response()->json(['ok' => true]), 'admin', 'super_admin');

    expect($response->getStatusCode())->toBe(200);
})->with([
    'admin' => Role::Admin,
    'super admin' => Role::SuperAdmin,
]);

it('denies users without an allowed role through the middleware', function (Role $role) {
    $user = User::factory()->create(['role' => $role]);

    $request = Request::create('/api/v1/tenants', 'GET');
    $request->setUserResolver(fn () => $user);

    $middleware = new RoleMiddleware;

    $response = $middleware->handle($request, fn () => response()->json(['ok' => true]), 'admin');

    expect($response->getStatusCode())->toBe(403);
})->with([
    'doctor' => Role::Doctor,
    'receptionist' => Role::Receptionist,
]);

it('returns unauthorized when no user is authenticated', function () {
    $request = Request::create('/api/v1/tenants', 'GET');
    $request->setUserResolver(fn () => null);

    $middleware = new RoleMiddleware;

    $response = $middleware->handle($request, fn () => response()->json(['ok' => true]), 'admin');

    expect($response->getStatusCode())->toBe(401);
});

it('casts user role to enum', function () {
    $user = User::factory()->doctor()->create();

    expect($user->fresh()->role)->toBe(Role::Doctor);
});

it('casts appointment visit type and status to enums', function () {
    $appointment = Appointment::factory()->create([
        'visit_type' => VisitType::Emergency,
        'status' => AppointmentStatus::Completed,
    ]);

    $appointment->refresh();

    expect($appointment->visit_type)->toBe(VisitType::Emergency)
        ->and($appointment->status)->toBe(AppointmentStatus::Completed);
});
