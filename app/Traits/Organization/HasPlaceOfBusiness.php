<?php

namespace App\Traits\Organization;

use App\Models\Admin\Organizations\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasPlaceOfBusiness
{
    /**
     * @return BelongsTo
     */
    public function placeOfBusiness(): BelongsTo
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'place_of_business_id')
            ->withTrashed();
    }
}
