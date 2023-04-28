<?php

namespace App\Traits\Documents\Shipment\PackingLists;

use App\Models\Contractors\BankAccountDetail;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\PlaceOfBusiness;
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
