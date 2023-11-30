<?php

namespace App\Models\Contractors;

use App\Models\Classifiers\Region;
use App\Traits\Contractor\HasContractor;
use App\Traits\Contractors\PlacesOfBusiness\Notifications;
use App\Traits\Document\HasInvoicesAndPackingLists;
use App\Traits\Documents\Shipment\HasUser;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель места осуществления деятельности контрагента.
 */
class PlaceOfBusiness extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifications;
    use HasUser;
    use HasInvoicesAndPackingLists;
    use HasContractor;
    use RelationshipsTrait;

    protected $table = 'contractors_places_of_business';

    protected $foreign_key = 'contractor_place_id';

    protected $fillable = [
        'user_id',
        'contractor_id',
        'identifier',
        'registered',
        'index',
        'region_id',
        'address',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Дата создания в формате d.m.Y.
     *
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
