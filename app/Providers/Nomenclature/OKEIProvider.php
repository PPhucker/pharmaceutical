<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifiers\Nomenclature\OKEI;
use App\Observers\Classifiers\Nomenclature\OKEIObserver;
use Illuminate\Support\ServiceProvider;

class OKEIProvider extends ServiceProvider
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
        OKEI::observe(OKEIObserver::class);
    }
}
