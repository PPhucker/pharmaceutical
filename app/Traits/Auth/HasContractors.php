<?php

namespace App\Traits\Auth;

use App\Models\Contractors\BankAccountDetail;
use App\Models\Contractors\ContactPerson;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasContractors
{
    /**
     * @return HasMany
     */
    public function contractors()
    {
        return $this->hasMany(Contractor::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contractorsPlacesOfBusiness()
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contractorsBankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class)
            ->withTrashed();
    }
}
