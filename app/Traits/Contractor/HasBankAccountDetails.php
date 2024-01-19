<?php

namespace App\Traits\Contractor;

use App\Models\Contractor\BankAccountDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasBankAccountDetails
{
    /**
     * @return HasMany
     */
    public function bankAccountDetails(): HasMany
    {
        return $this->hasMany(BankAccountDetail::class, $this->foreign_key)
            ->withTrashed();
    }
}
