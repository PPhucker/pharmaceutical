<?php

namespace App\Observers\Classifiers\Nomenclature\Materials;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Materials\TypeOfMaterial;

class TypeOfMaterialObserver
{
    /**
     * Handle the TypeOfMaterial "created" event.
     *
     * @param TypeOfMaterial $typeOfMaterial
     *
     * @return void
     */
    public function created(TypeOfMaterial $typeOfMaterial)
    {
        Logger::userActionNotice('create', $typeOfMaterial);
    }

    /**
     * Handle the TypeOfMaterial "updated" event.
     *
     * @param TypeOfMaterial $typeOfMaterial
     *
     * @return void
     */
    public function updated(TypeOfMaterial $typeOfMaterial)
    {
        Logger::userActionNotice('update', $typeOfMaterial);
    }
}
