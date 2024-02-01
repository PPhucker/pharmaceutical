<?php

namespace App\Traits\Classifier\Nomenclature\Product\Relation;

use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEndProducts
{
    /**
     * @return HasMany
     */
    public function endProducts(): HasMany
    {
        return $this->hasMany(EndProduct::class, $this->foreign_key)
            ->withTrashed();
    }
}
