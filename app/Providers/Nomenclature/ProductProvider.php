<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifier\Nomenclature\Products\EndProduct;
use App\Models\Classifier\Nomenclature\Products\InternationalNameOfEndProduct;
use App\Models\Classifier\Nomenclature\Products\OKPD2;
use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use App\Models\Classifier\Nomenclature\Products\ProductPrice;
use App\Models\Classifier\Nomenclature\Products\ProductRegionalAllowance;
use App\Models\Classifier\Nomenclature\Products\RegistrationNumberOfEndProduct;
use App\Models\Classifier\Nomenclature\Products\TypeOfAggregation;
use App\Models\Classifier\Nomenclature\Products\TypeOfEndProduct;
use App\Observers\Classifier\Nomenclature\Product\EndProductObserver;
use App\Observers\Classifier\Nomenclature\Product\InternationalNameOfEndProductObserver;
use App\Observers\Classifier\Nomenclature\Product\OKPD2Observer;
use App\Observers\Classifier\Nomenclature\Product\ProductCatalogObserver;
use App\Observers\Classifier\Nomenclature\Product\ProductPriceObserver;
use App\Observers\Classifier\Nomenclature\Product\ProductRegionalAllowanceObserver;
use App\Observers\Classifier\Nomenclature\Product\RegistrationNumberOfEndProductObserver;
use App\Observers\Classifier\Nomenclature\Product\TypeOfAggregationObserver;
use App\Observers\Classifier\Nomenclature\Product\TypeOfEndProductObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис-провайдер продукции.
 */
class ProductProvider extends ServiceProvider
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
    public function boot(): void
    {
        TypeOfEndProduct::observe(TypeOfEndProductObserver::class);
        InternationalNameOfEndProduct::observe(InternationalNameOfEndProductObserver::class);
        OKPD2::observe(OKPD2Observer::class);
        RegistrationNumberOfEndProduct::observe(RegistrationNumberOfEndProductObserver::class);
        EndProduct::observe(EndProductObserver::class);
        TypeOfAggregation::observe(TypeOfAggregationObserver::class);
        ProductCatalog::observe(ProductCatalogObserver::class);
        ProductPrice::observe(ProductPriceObserver::class);
        ProductRegionalAllowance::observe(ProductRegionalAllowanceObserver::class);
    }
}
