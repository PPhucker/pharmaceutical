<?php

namespace App\Traits\Auth\Documents\Shipment;

use App\Models\Documents\Shipment\Appendixes\Appendix;
use App\Models\Documents\Shipment\Bills\Bill;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Models\Documents\Shipment\Protocols\Protocol;
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

    /**
     * @return HasMany
     */
    public function updatedBills()
    {
        return $this->hasMany(Bill::class, 'updated_by_id');
    }

    /**
     * @return HasMany
     */
    public function approvedBills()
    {
        return $this->hasMany(Bill::class, 'approved_by_id');
    }

    /**
     * @return HasMany
     */
    public function createdAppendixes()
    {
        return $this->hasMany(Appendix::class, 'created_by_id');
    }

    /**
     * @return HasMany
     */
    public function updatedAppendixes()
    {
        return $this->hasMany(Appendix::class, 'updated_by_id');
    }

    /**
     * @return HasMany
     */
    public function approvedAppendixes()
    {
        return $this->hasMany(Appendix::class, 'approved_by_id');
    }

    /**
     * @return HasMany
     */
    public function createdProtocols()
    {
        return $this->hasMany(Protocol::class, 'created_by_id');
    }

    /**
     * @return HasMany
     */
    public function updatedProtocols()
    {
        return $this->hasMany(Protocol::class, 'updated_by_id');
    }

    /**
     * @return HasMany
     */
    public function approvedProtocols()
    {
        return $this->hasMany(Protocol::class, 'approved_by_id');
    }
}
