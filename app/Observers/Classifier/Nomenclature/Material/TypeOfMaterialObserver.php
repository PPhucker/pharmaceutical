<?php

namespace App\Observers\Classifier\Nomenclature\Material;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Materials\TypeOfMaterial;

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
