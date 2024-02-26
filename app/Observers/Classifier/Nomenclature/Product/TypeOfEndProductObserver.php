<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\TypeOfEndProduct;

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
