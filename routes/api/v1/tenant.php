<?php 
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {



    // appointments routes: 
    



});
