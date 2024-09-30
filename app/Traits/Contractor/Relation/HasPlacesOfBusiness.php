<?php

namespace App\Traits\Contractor\Relation;

use App\Models\Contractor\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPlacesOfBusiness
{
    /**
     * @return HasMany
     */
    public function placesOfBusiness(): HasMany
    {
        return $this->hasMany(PlaceOfBusiness::class, $this->foreign_key)
            ->withTrashed();
    }
}
