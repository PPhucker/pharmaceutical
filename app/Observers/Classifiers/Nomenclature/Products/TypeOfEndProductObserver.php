<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\TypeOfEndProduct;

class TypeOfEndProductObserver
{
    /**
     * Handle the TypeOfEndProduct "created" event.
     *
     * @param TypeOfEndProduct $typeOfEndProduct
     *
     * @return void
     */
    public function created(TypeOfEndProduct $typeOfEndProduct)
    {
        Logger::userActionNotice('create', $typeOfEndProduct);
    }

    /**
     * Handle the TypeOfEndProduct "updated" event.
     *
     * @param TypeOfEndProduct $typeOfEndProduct
     *
     * @return void
     */
    public function updated(TypeOfEndProduct $typeOfEndProduct)
    {
        Logger::userActionNotice('update', $typeOfEndProduct);
    }
}
