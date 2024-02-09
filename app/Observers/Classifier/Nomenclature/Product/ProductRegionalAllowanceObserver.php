<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Products\ProductRegionalAllowance;

/**
 * Наблюдатель региональной надбавки готовой продукции.
 */
class ProductRegionalAllowanceObserver
{
    /**
     * Handle the ProductRegionalAllowance "created" event.
     *
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return void
     */
    public function created(ProductRegionalAllowance $productRegionalAllowance): void
    {
        Logger::userActionNotice('create', $productRegionalAllowance);
    }

    /**
     * Handle the ProductRegionalAllowance "updated" event.
     *
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return void
     */
    public function updated(ProductRegionalAllowance $productRegionalAllowance): void
    {
        Logger::userActionNotice('update', $productRegionalAllowance);
    }

    /**
     * Handle the ProductRegionalAllowance "deleted" event.
     *
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return void
     */
    public function deleted(ProductRegionalAllowance $productRegionalAllowance): void
    {
        Logger::userActionNotice('delete', $productRegionalAllowance);
    }

    /**
     * Handle the ProductRegionalAllowance "restored" event.
     *
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return void
     */
    public function restored(ProductRegionalAllowance $productRegionalAllowance): void
    {
        Logger::userActionNotice('restore', $productRegionalAllowance);
    }
}
