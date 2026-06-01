<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

/**
 * Auth routes 
 * @prefix /auth
 * 

 * POST /auth/login - Login a user
 * POST /auth/register - Register a new user
 * 
 * protected routes 
 * ----------------
 * GET /auth/logout - Logout the authenticated user
 * GET /auth/refresh - Refresh the authenticated user's token
 * GET /auth/me - Get the authenticated user
 */




Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // protected routes 
    Route::middleware('auth:api')->group(function () {  
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});