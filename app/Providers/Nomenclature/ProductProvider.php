<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct;
use App\Models\Classifiers\Nomenclature\Products\OKPD2;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use App\Models\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct;
use App\Models\Classifiers\Nomenclature\Products\TypeOfAggregation;
use App\Models\Classifiers\Nomenclature\Products\TypeOfEndProduct;
use App\Observers\Classifiers\Nomenclature\Products\EndProductObserver;
use App\Observers\Classifiers\Nomenclature\Products\InternationalNameOfEndProductObserver;
use App\Observers\Classifiers\Nomenclature\Products\OKPD2Observer;
use App\Observers\Classifiers\Nomenclature\Products\ProductCatalogObserver;
use App\Observers\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProductObserver;
use App\Observers\Classifiers\Nomenclature\Products\TypeOfAggregationObserver;
use App\Observers\Classifiers\Nomenclature\Products\TypeOfEndProductObserver;
use App\Repositories\Classifiers\Nomenclature\Products\ProductPriceRepository;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        TypeOfEndProduct::observe(TypeOfEndProductObserver::class);
        InternationalNameOfEndProduct::observe(InternationalNameOfEndProductObserver::class);
        OKPD2::observe(OKPD2Observer::class);
        RegistrationNumberOfEndProduct::observe(RegistrationNumberOfEndProductObserver::class);
        EndProduct::observe(EndProductObserver::class);
        TypeOfAggregation::observe(TypeOfAggregationObserver::class);
        ProductCatalog::observe(ProductCatalogObserver::class);
        ProductPrice::observe(ProductPriceRepository::class);
    }
}
