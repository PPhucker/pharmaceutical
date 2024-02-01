<?php

namespace App\Models\Admin\Organization;

use App\Models\Contractor\PlaceOfBusiness as ContractorPlaceOfBusiness;
use App\Traits\Document\Relation\HasInvoicesAndPackingLists;
use App\Traits\Organization\Relation\HasOrganization;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель места осуществления деятельности контрагента.
 */
class PlaceOfBusiness extends ContractorPlaceOfBusiness
{
    use HasFactory;
    use SoftDeletes;
    use HasOrganization;
    use HasUser;
    use HasInvoicesAndPackingLists;

    protected $table = 'organizations_places_of_business';

    protected $foreign_key = 'organization_place_id';

    protected $fillable = [
        'user_id',
        'organization_id',
        'identifier',
        'registered',
        'index',
        'address',
    ];

    /**
     * @return HasMany
     */
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'organization_place_of_business_id')
            ->withoutTrashed();
    }
}
