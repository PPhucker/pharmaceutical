<?php

namespace App\Traits\Classifier\Nomenclature\Product\Relation;

use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasEndProduct
{
    /**
     * @return BelongsTo
     */
    public function endProduct(): BelongsTo
    {
        return $this->belongsTo(EndProduct::class, 'product_id')
            ->withTrashed();
    }
}
