<?php

namespace App\Providers\Classifier\Nomenclature\Catalog;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice;
use App\Models\Classifier\Nomenclature\Product\Catalog\Price\WholesalePrice;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\Product\Catalog\Price\PriceServiceDependencies;
use App\Services\Classifier\Nomenclature\Product\Catalog\ProductCatalogService;
use App\Services\Classifier\Nomenclature\Product\Type\TypeServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер каталога продукта.
 */
class ProductCatalogServiceProvider extends ServiceProvider
{
    protected $coreObservedModels = [
        ProductCatalog::class,
        TypeOfAggregation::class,
        ProductPrice::class,
        WholesalePrice::class,
    ];

    protected $services = [
        ProductCatalogService::class,
        TypeServiceDependencies::class,
        PriceServiceDependencies::class,
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
