<?php

namespace App\Traits\Auth\Documents;

use App\Models\Documents\Acts\Act;
use App\Models\Documents\Acts\ActService;
use App\Models\Documents\InvoicesForPayment\DataInvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial;
use App\Traits\Auth\Documents\Shipment\HasShipmentDocuments;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    use HasShipmentDocuments;

    /**
     * @return HasMany
     */
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function invoiceForPaymentProducts()
    {
        return $this->hasMany(DataInvoiceForPayment::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function invoiceForPaymentMaterials()
    {
        return $this->hasMany(InvoiceForPaymentMaterial::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function acts()
    {
        return $this->hasMany(Act::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function actServices()
    {
        return $this->hasMany(ActService::class, 'user_id')
            ->withTrashed();
    }
}
