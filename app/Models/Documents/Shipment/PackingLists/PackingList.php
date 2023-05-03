<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\PackingLists\HasContractor;
use App\Traits\Documents\Shipment\PackingLists\HasOrganization;
use App\Traits\Documents\Shipment\PackingLists\HasShipmentDocuments;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingList extends Shipment
{
    use HasOrganization;
    use HasContractor;
    use HasShipmentDocuments;

    public const STORAGE = self::SHIPMENT_STORAGE . '/packing_lists/';

    protected $table = 'documents_shipment_packing_lists';

    /**
     * @param array $fillable
     *
     * @return $this|PackingList
     */
    public function fillable(array $fillable)
    {
        $this->fillable = array_merge(
            $this->fillable,
            [
                'organization_id',
                'organization_place_id',
                'organization_bank_id',
                'contractor_id',
                'contractor_place_id',
                'contractor_bank_id',
                'director',
                'bookkeeper',
                'storekeeper',
            ]
        );

        return $this;
    }

    /**
     * @return HasMany
     */
    public function production()
    {
        return $this->hasMany(PackingListProduct::class, 'packing_list_id')
            ->withTrashed();
    }
}
