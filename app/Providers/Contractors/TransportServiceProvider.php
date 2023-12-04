<?php

namespace App\Providers\Contractors;

use App\Models\Contractors\Transport\Car;
use App\Models\Contractors\Transport\Driver;
use App\Models\Contractors\Transport\Trailer;
use App\Observers\CoreObserver;
use App\Providers\Nomenclature\ServiceProvider;
use App\Services\Contractor\Transport\TransportServiceDependencies;

/**
 * Сервис провайдер транспорта контрагента.
 */
class TransportServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $coreObservedModels = [
        Driver::class,
        Car::class,
        Trailer::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TransportServiceDependencies::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->coreObservedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
