<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
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
}
