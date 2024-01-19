<?php

namespace App\Providers\Contractor;

use App\Models\Classifiers\Region;
use App\Models\Contractor\PlaceOfBusiness;
use App\Observers\Contractor\PlaceOfBusinessObserver;
use App\Observers\CoreObserver;
use App\Services\Contractor\Address\AddressServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер адреса контрагента.
 */
class AddressServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $coreObservedModels = [
        Region::class,
    ];

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

        foreach ($this->coreObservedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
