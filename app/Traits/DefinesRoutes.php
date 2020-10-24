<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Laravel\Vapor\Contracts\SignedStorageUrlController;

trait DefinesRoutes
{
    /**
     * Ensure that Vapor's internal routes are defined.
     *
     * @return void
     */
    public function ensureRoutesAreDefined()
    {
        logger('ensureRoutesAreDefined');
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::post(
            '/vapor/signed-storage-url',
            SignedStorageUrlController::class.'@store'
        )->middleware('auth:sanctum');
    }
}
