<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    /**
     * @return HasMany
     */
    public function invoiceForPaymentProduction()
    {
        return $this->hasMany(InvoiceForPaymentProduct::class, 'product_catalog_id');
    }

    /**
     * @return HasMany
     */
    public function packingListProduction()
    {
        return $this->hasMany(PackingListProduct::class, 'product_id');
    }
}
