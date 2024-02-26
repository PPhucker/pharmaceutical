<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\ProductCatalog;

class ProductCatalogObserver
{
    /**
     * Handle the ProductCatalog "created" event.
     *
     * @param ProductCatalog $productCatalog
     *
     * @return void
     */
    public function created(ProductCatalog $productCatalog)
    {
        Logger::userActionNotice('create', $productCatalog);
    }

    /**
     * Handle the ProductCatalog "updated" event.
     *
     * @param ProductCatalog $productCatalog
     *
     * @return void
     */
    public function updated(ProductCatalog $productCatalog)
    {
        Logger::userActionNotice('update', $productCatalog);
    }

    /**
     * Handle the ProductCatalog "deleting" event.
     *
     * @param ProductCatalog  $productCatalog
     *
     * @return void
     */
    public function deleting(ProductCatalog $productCatalog)
    {
        foreach ($productCatalog->prices()->get() as $price) {
            $price->delete();
        }

        $productCatalog->materials()->sync([]);
        $productCatalog->aggregationTypes()->sync([]);
    }

    /**
     * Handle the ProductCatalog "deleted" event.
     *
     * @param ProductCatalog  $productCatalog
     *
     * @return void
     */
    public function deleted(ProductCatalog $productCatalog)
    {
        Logger::userActionNotice('destroy', $productCatalog);
    }

    /**
     * Handle the ProductCatalog "restored" event.
     *
     * @param ProductCatalog  $productCatalog
     *
     * @return void
     */
    public function restored(ProductCatalog $productCatalog)
    {
        foreach ($productCatalog->prices()->get() as $price) {
            $price->restore();
        }

        Logger::userActionNotice('restore', $productCatalog);
    }
}
