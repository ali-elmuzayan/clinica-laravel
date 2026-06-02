<?php

use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ExportsController;
use App\Http\Controllers\Api\V1\TenantController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    // Get all tenants for admin
    Route::prefix('tenants')->middleware('role:admin')->group(function () {
        Route::get('/', [TenantController::class, 'index']);
        Route::get('/{tenant}', [TenantController::class, 'show']);
        Route::put('/{tenant}', [TenantController::class, 'update']);
        Route::delete('/{tenant}', [TenantController::class, 'destroy']);
    });

    // dashboard routes
    Route::get('/api/dashboard', [DashboardController::class, 'index']);

    // FILE Operations routes
    Route::post('/api/exports/appointments/pdf', [ExportsController::class, 'appointmentsPdf']);
    Route::get('/api/exports/:exportId/status', [ExportsController::class, 'exportStatus']);
    Route::get('/api/exports/:exportId/download', [ExportsController::class, 'exportDownload']);

    //
});
