<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Traits\Documents\Shipment\HasUser;
use App\Traits\Documents\Shipment\PackingLists\HasContractor;
use App\Traits\Documents\Shipment\PackingLists\HasOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class PackingList extends Model
{
    use HasFactory, SoftDeletes, HasOrganization, HasContractor, HasUser;

    public const STORAGE = 'public/documents/shipment/packing_lists';

    protected $table = 'documents_shipment_packing_lists';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'approved_at',
    ];

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'approved_by_id',
        'organization_id',
        'organization_place_id',
        'organization_bank_id',
        'contractor_id',
        'contractor_place_id',
        'contractor_bank_id',
        'number',
        'date',
        'director',
        'bookkeeper',
        'storekeeper',
        'approved',
        'comment',
        'filename',
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getApprovedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
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
