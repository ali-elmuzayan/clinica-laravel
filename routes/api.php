<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;




Route::prefix('v1')->group(function () {

    // Auth routes
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        // Auth routes
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/refresh', [AuthController::class, 'refresh']);
        // User routes
        Route::get('/auth/me', [AuthController::class, 'me']);
    });



    // apointments routes

    
});