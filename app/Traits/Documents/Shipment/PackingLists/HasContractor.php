<?php

namespace App\Traits\Documents\Shipment\PackingLists;

use App\Models\Contractor\BankAccountDetail;
use App\Models\Contractor\Contractor;
use App\Models\Contractor\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasContractor
{
    /**
     * @return BelongsTo
     */
    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function contractorPlaceOfBusiness()
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'contractor_place_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function contractorBankAccountDetail()
    {
        return $this->belongsTo(BankAccountDetail::class, 'contractor_bank_id')
            ->withTrashed();
    }
}
