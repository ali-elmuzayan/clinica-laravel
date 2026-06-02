<?php 

use Illuminate\Support\Facades\Route;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // Auth routes
        require_once __DIR__ . '/auth.php';

        // API routes
        require_once __DIR__ . '/api.php';
    });
}