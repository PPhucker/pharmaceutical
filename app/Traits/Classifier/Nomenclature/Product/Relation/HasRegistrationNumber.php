<?php

namespace App\Traits\Classifier\Nomenclature\Product\Relation;

use App\Models\Classifier\Nomenclature\Products\RegistrationNumberOfEndProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRegistrationNumber
{
    /**
     * @return BelongsTo
     */
    public function registrationNumber(): BelongsTo
    {
        return $this->belongsTo(RegistrationNumberOfEndProduct::class, 'registration_number_id');
    }
}
