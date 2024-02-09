<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifier\Nomenclature\Materials\Material;
use App\Models\Classifier\Nomenclature\Materials\TypeOfMaterial;
use App\Observers\Classifier\Nomenclature\Material\MaterialObserver;
use App\Observers\Classifier\Nomenclature\Material\TypeOfMaterialObserver;
use Illuminate\Support\ServiceProvider;

class MaterialProvider extends ServiceProvider
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
        TypeOfMaterial::observe(TypeOfMaterialObserver::class);
        Material::observe(MaterialObserver::class);
    }
}
