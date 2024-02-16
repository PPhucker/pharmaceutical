<?php

namespace App\Providers\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\OKEI;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\OKEIService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер номенклатуры.
 */
class NomenclatureServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $observedModels = [
        OKEI::class,
    ];

    /**
     * @var string[]
     */
    protected $services = [
        OKEIService::class,
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
        foreach ($this->observedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
