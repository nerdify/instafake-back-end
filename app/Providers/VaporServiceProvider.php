<?php

namespace App\Providers;

use App\Traits\DefinesRoutes;
use Laravel\Vapor\VaporServiceProvider as BaseVaporServiceProvider;

class VaporServiceProvider extends BaseVaporServiceProvider
{
    use DefinesRoutes;


    public function boot()
    {
        logger('boot');
        parent::boot();
    }
}
