<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifiers\Nomenclature\Services\Service;
use App\Observers\Classifiers\Nomenclature\Services\ServiceObserver;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Service::observe(ServiceObserver::class);
    }
}
