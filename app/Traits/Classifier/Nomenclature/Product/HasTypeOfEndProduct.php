<?php

namespace App\Traits\Classifier\Nomenclature\Product;

use App\Models\Classifiers\Nomenclature\Products\TypeOfEndProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTypeOfEndProduct
{
    /**
     * @return mixed
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeOfEndProduct::class, 'type_id');
    }
}
