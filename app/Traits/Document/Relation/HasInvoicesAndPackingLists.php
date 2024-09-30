<?php

namespace App\Traits\Document\Relation;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Трейт для связи контрагента с документами.
 */
trait HasInvoicesAndPackingLists
{
    /**
     * Счета на оплату, связанные с контрагентом.
     *
     * @return HasMany
     */
    public function invoicesForPayment(): HasMany
    {
        return $this->hasMany(InvoiceForPayment::class, $this->foreign_key)
            ->withTrashed();
    }

    /**
     * Товарно-транспортные накладные, связанные с контрагентом.
     *
     * @return HasMany
     */
    public function packingLists(): HasMany
    {
        return $this->hasMany(PackingList::class, $this->foreign_key);
    }
}
