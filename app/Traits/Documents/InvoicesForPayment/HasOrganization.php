<?php

namespace App\Traits\Documents\InvoicesForPayment;

use App\Models\Admin\Organization\BankAccountDetail;
use App\Models\Admin\Organization\Organization;
use App\Models\Admin\Organization\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOrganization
{
    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function organizationPlaceOfBusiness()
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'organization_place_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function organizationBankAccountDetail()
    {
        return $this->belongsTo(BankAccountDetail::class, 'organization_bank_id')
            ->withTrashed();
    }
}
