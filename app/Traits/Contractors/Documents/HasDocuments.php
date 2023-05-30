<?php

namespace App\Traits\Contractors\Documents;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    /**
     * @return HasMany
     */
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function packingLists()
    {
        return $this->hasMany(PackingList::class, 'contractor_id');
    }
}
