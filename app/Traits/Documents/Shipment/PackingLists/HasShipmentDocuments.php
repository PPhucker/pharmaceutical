<?php

namespace App\Traits\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Bills\Bill;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasShipmentDocuments
{
    /**
     * @return HasOne
     */
    public function bill()
    {
        return $this->hasOne(Bill::class, 'packing_list_id')
            ->withTrashed();
    }
}
