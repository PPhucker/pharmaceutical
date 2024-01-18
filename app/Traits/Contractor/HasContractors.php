<?php

namespace App\Traits\Contractor;

use App\Models\Contractors\Contractor;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasContractors
{
    use HasBankAccountDetails;
    use HasContactPersons;
    use HasPlacesOfBusiness;

    /**
     * @return HasMany
     */
    public function contractors(): HasMany
    {
        return $this->hasMany(Contractor::class, $this->foreign_key)
            ->withTrashed();
    }
}
