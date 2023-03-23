<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct;

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
