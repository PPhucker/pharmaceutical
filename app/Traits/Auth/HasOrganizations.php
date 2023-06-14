<?php

namespace App\Traits\Auth;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Admin\Organizations\BankAccountDetail;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness as OrganizationPlaceOfBusiness;

trait HasOrganizations
{
    /**
     * @return HasMany
     */
    public function organizations()
    {
        return $this->hasMany(Organization::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function organizationsPlacesOfBusiness()
    {
        return $this->hasMany(OrganizationPlaceOfBusiness::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }
}
