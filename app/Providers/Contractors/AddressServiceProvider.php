<?php

namespace App\Providers\Contractors;

use App\Models\Classifiers\Region;
use App\Models\Contractors\PlaceOfBusiness;
use App\Observers\Classifiers\RegionObserver;
use App\Observers\Contractors\PlaceOfBusinessObserver;
use App\Services\Contractor\Address\AddressServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер адреса контрагента.
 */
class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AddressServiceDependencies::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        PlaceOfBusiness::observe(PlaceOfBusinessObserver::class);
        Region::observe(RegionObserver::class);
    }
}
