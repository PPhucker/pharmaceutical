<?php

namespace App\Traits\Documents\Shipment;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasPackingList
{
    /**
     * @param array $fillable
     *
     * @return $this
     */
    public function fillable(array $fillable)
    {
        $this->fillable[] = 'packing_list_id';

        return $this;
    }

    /**
     * @return BelongsTo
     */
    public function packingList()
    {
        return $this->belongsTo(PackingList::class, 'packing_list_id')
            ->withTrashed();
    }
}
