<?php

namespace App\Providers\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\OKEI;
use App\Models\Classifier\Nomenclature\Service;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\OKEIService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер номенклатуры.
 */
class NomenclatureServiceProvider extends ServiceProvider
{
    protected $providers = [
        EndProductServiceProvider::class,
    ];

    /**
     * @var string[]
     */
    protected $observedModels = [
        OKEI::class,
        Service::class,
    ];

    /**
     * @var string[]
     */
    protected $services = [
        OKEIService::class,
        Service::class,
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        foreach ($this->services as $service) {
            $this->app->singleton($service);
        }

        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->observedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
