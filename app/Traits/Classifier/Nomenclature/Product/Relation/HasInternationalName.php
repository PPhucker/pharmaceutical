<?php

namespace App\Traits\Classifier\Nomenclature\Product\Relation;

use App\Models\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasInternationalName
{
    /**
     * @return BelongsTo
     */
    public function internationalName(): BelongsTo
    {
        return $this->belongsTo(InternationalNameOfEndProduct::class, 'international_name_id');
    }
}
