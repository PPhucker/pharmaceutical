<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Products\InternationalNameOfEndProduct;

class InternationalNameOfEndProductObserver
{
    /**
     * Handle the InternationalNameOfEndProduct "created" event.
     *
     * @param InternationalNameOfEndProduct $internationalNameOfEndProduct
     *
     * @return void
     */
    public function created(InternationalNameOfEndProduct $internationalNameOfEndProduct)
    {
        Logger::userActionNotice('create', $internationalNameOfEndProduct);
    }

    /**
     * Handle the InternationalNameOfEndProduct "updated" event.
     *
     * @param InternationalNameOfEndProduct $internationalNameOfEndProduct
     *
     * @return void
     */
    public function updated(InternationalNameOfEndProduct $internationalNameOfEndProduct)
    {
        Logger::userActionNotice('update', $internationalNameOfEndProduct);
    }
}
