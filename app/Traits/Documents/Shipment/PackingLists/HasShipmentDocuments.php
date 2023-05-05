<?php

namespace App\Traits\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Appendixes\Appendix;
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

    /**
     * @return HasOne
     */
    public function appendix()
    {
        return $this->hasOne(Appendix::class, 'packing_list_id')
            ->withTrashed();
    }
}
