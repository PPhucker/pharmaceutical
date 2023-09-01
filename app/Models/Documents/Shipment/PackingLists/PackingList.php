<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\Notifications;
use App\Traits\Documents\Shipment\PackingLists\HasContractor;
use App\Traits\Documents\Shipment\PackingLists\HasOrganization;
use App\Traits\Documents\Shipment\PackingLists\HasShipmentDocuments;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель товарной накладной.
 */
class PackingList extends Shipment
{
    use HasOrganization;
    use HasContractor;
    use HasShipmentDocuments;
    use Notifications;

    public const STORAGE = self::SHIPMENT_STORAGE . '/packing_lists/';

    protected $table = 'documents_shipment_packing_lists';

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'approved_by_id',
        'packing_list_id',
        'number',
        'date',
        'approved',
        'comment',
        'filename',
        'approved_at',
        'organization_id',
        'organization_place_id',
        'organization_bank_id',
        'contractor_id',
        'contractor_place_id',
        'contractor_bank_id',
        'director',
        'bookkeeper',
        'storekeeper',
    ];

    /**
     * @return HasMany
     */
    public function production(): HasMany
    {
        return $this->hasMany(PackingListProduct::class, 'packing_list_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function data(): HasMany
    {
        return $this->hasMany(PackingListProduct::class, 'packing_list_id')
            ->withoutTrashed();
    }
}
