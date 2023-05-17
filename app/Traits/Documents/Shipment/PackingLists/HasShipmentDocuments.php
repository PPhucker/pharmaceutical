<?php

namespace App\Traits\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Appendixes\Appendix;
use App\Models\Documents\Shipment\Bills\Bill;
use App\Models\Documents\Shipment\Protocols\Protocol;
use App\Models\Documents\Shipment\Waybills\Waybill;
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

    /**
     * @return HasOne
     */
    public function protocol()
    {
        return $this->hasOne(Protocol::class, 'packing_list_id')
            ->withTrashed();
    }

    /**
     * @return HasOne
     */
    public function waybill()
    {
        return $this->hasOne(Waybill::class, 'packing_list_id')
            ->withTrashed();
    }
}
