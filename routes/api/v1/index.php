<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AppointmentController;
use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ExportsController;






Route::middleware('auth:api')->group(function () {
    // apointments routes
    Route::get('/api/appointments', [AppointmentController::class, 'index']);
    Route::post('/api/appointments', [AppointmentController::class, 'store']);
    Route::get('/api/appointments/today', [AppointmentController::class, 'today']);
    Route::get('/api/appointments/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/api/appointments/{appointment}', [AppointmentController::class, 'update']);
    Route::delete('/api/appointments/{appointment}', [AppointmentController::class, 'destroy']);


    // patients routes
    Route::get('/api/patients', [PatientController::class, 'index']);
    Route::post('/api/patients', [PatientController::class, 'store']);
    Route::get('/api/patients/{patient}', [PatientController::class, 'show']);
    Route::put('/api/patients/{patient}', [PatientController::class, 'update']);
    Route::delete('/api/patients/{patient}', [PatientController::class, 'destroy']);



    // dashboard routes
    Route::get('/api/dashboard', [DashboardController::class, 'index']);


    // FILE Operations routes 
    Route::post('/api/exports/appointments/pdf', [ExportsController::class, 'appointmentsPdf']);
    Route::get('/api/exports/:exportId/status', [ExportsController::class, 'exportStatus']);
    Route::get('/api/exports/:exportId/download', [ExportsController::class, 'exportDownload']);


    // 
}); 


// Auth routes
require_once __DIR__ . '/auth.php';