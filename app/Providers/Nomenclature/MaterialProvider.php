<?php

namespace App\Providers\Nomenclature;

use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Models\Classifiers\Nomenclature\Materials\TypeOfMaterial;
use App\Observers\Classifiers\Nomenclature\Materials\MaterialObserver;
use App\Observers\Classifiers\Nomenclature\Materials\TypeOfMaterialObserver;
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
