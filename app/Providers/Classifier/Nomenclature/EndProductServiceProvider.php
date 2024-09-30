<?php

namespace App\Providers\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Models\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;
use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\Product\EndProductServiceDependencies;
use App\Services\Classifier\Nomenclature\Product\Type\TypeServiceDependencies;
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
        TypeOfEndProduct::class,
        TypeOfAggregation::class,
    ];

    protected $services = [
        EndProductServiceDependencies::class,
        TypeServiceDependencies::class,
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
