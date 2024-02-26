<?php

namespace App\Providers\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Models\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;
use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\Product\EndProductServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер конечного продукта.
 */
class EndProductServiceProvider extends ServiceProvider
{
    protected $coreObservedModels = [
        EndProduct::class,
        InternationalNameOfEndProduct::class,
        OKPD2::class,
        RegistrationNumberOfEndProduct::class,
    ];

    protected $services = [
        EndProductServiceDependencies::class,
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        foreach ($this->services as $service) {
            $this->app->singleton($service);
        }
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->coreObservedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
