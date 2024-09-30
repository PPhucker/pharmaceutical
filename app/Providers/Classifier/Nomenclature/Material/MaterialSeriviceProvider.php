<?php

namespace App\Providers\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Material\Material;
use App\Models\Classifier\Nomenclature\Material\TypeOfMaterial;
use App\Observers\CoreObserver;
use App\Services\Classifier\Nomenclature\Material\MaterialService;
use App\Services\Classifier\Nomenclature\Material\TypeOfMaterialService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер комплектации.
 */
class MaterialSeriviceProvider extends ServiceProvider
{
    protected $coreObservedModels = [
        Material::class,
        TypeOfMaterial::class,
    ];

    protected $services = [
        TypeOfMaterialService::class,
        MaterialService::class,
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
