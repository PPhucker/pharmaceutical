<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;

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
     * Handle the EndProduct "deleting" event.
     *
     * @param EndProduct $endProduct
     *
     * @return void
     */
    public function deleting(EndProduct $endProduct)
    {
        $endProduct->materials()->sync([]);
        $endProduct->aggregationTypes()->sync([]);
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
        Logger::userActionNotice('restore', $endProduct);
    }
}
