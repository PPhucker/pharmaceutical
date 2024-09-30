<?php

namespace App\Providers\Classifier;

use App\Models\Classifier\Bank;
use App\Models\Classifier\LegalForm;
use App\Models\Classifier\Region;
use App\Observers\CoreObserver;
use App\Providers\Classifier\Nomenclature\NomenclatureServiceProvider;
use App\Services\Classifier\ClassifierServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер классификаторов.
 */
class ClassifierServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $providers = [
        NomenclatureServiceProvider::class,
    ];
    protected $observedModels = [
        Bank::class,
        LegalForm::class,
        Region::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ClassifierServiceDependencies::class);

        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->observedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
