<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Products\EndProduct;

class EndProductObserver
{
    /**
     * Handle the EndProduct "created" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function created(EndProduct $endProduct)
    {
        Logger::userActionNotice('create', $endProduct);
    }

    /**
     * Handle the EndProduct "updated" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function updated(EndProduct $endProduct)
    {
        Logger::userActionNotice('update', $endProduct);
    }

    /**
     * Handle the EndProduct "deleting" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function deleting(EndProduct $endProduct)
    {
        foreach ($endProduct->catalogProducts()->get() as $catalogProduct) {
            $catalogProduct->delete();
        }
    }

    /**
     * Handle the EndProduct "deleted" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function deleted(EndProduct $endProduct)
    {
        Logger::userActionNotice('destroy', $endProduct);
    }

    /**
     * Handle the EndProduct "restored" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function restored(EndProduct $endProduct)
    {
        foreach ($endProduct->catalogProducts()->get() as $catalogProduct) {
            $catalogProduct->restore();
        }

        Logger::userActionNotice('restore', $endProduct);
    }
}
