<?php

namespace App\Traits\Auth\Documents\Shipment;

use App\Models\Documents\Shipment\Bills\Bill;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasShipmentDocuments
{
    /**
     * @return HasMany
     */
    public function createdPackingLists()
    {
        return $this->hasMany(PackingList::class, 'created_by_id');
    }

    /**
     * @return HasMany
     */
    public function updatedPackingLists()
    {
        return $this->hasMany(PackingList::class, 'updated_by_id');
    }

    /**
     * @return HasMany
     */
    public function approvedPackingLists()
    {
        return $this->hasMany(PackingList::class, 'approved_by_id');
    }

    /**
     * @return HasMany
     */
    public function createdBills()
    {
        return $this->hasMany(Bill::class, 'created_by_id');
    }

    public function updatedBills()
    {
        return $this->hasMany(Bill::class, 'updated_by_id');
    }

    public function approvedBills()
    {
        return $this->hasMany(Bill::class, 'approved_by_id');
    }
}
