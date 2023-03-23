<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;

class ProductPriceObserver
{
    /**
     * Handle the ProductPrice "created" event.
     *
     * @param ProductPrice $productPrice
     *
     * @return void
     */
    public function created(ProductPrice $productPrice)
    {
        Logger::userActionNotice('create', $productPrice);
    }

    /**
     * Handle the ProductPrice "updated" event.
     *
     * @param ProductPrice $productPrice
     *
     * @return void
     */
    public function updated(ProductPrice $productPrice)
    {
        Logger::userActionNotice('update', $productPrice);
    }

    /**
     * Handle the ProductPrice "deleted" event.
     *
     * @param ProductPrice  $productPrice
     *
     * @return void
     */
    public function deleted(ProductPrice $productPrice)
    {
        Logger::userActionNotice('destroy', $productPrice);
    }

    /**
     * Handle the ProductPrice "restored" event.
     *
     * @param ProductPrice  $productPrice
     *
     * @return void
     */
    public function restored(ProductPrice $productPrice)
    {
        Logger::userActionNotice('restore', $productPrice);
    }
}
