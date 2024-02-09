<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifier\Nomenclature\Services\Service;
use App\Observers\Classifier\Nomenclature\Service\ServiceObserver;
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
