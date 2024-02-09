<?php

namespace App\Traits\Classifier\Nomenclature\Product\Relation;

use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCatalogProducts
{
    /**
     * @return HasMany
     */
    public function catalogProducts(): HasMany
    {
        return $this->hasMany(ProductCatalog::class, $this->foreign_key);
    }
}
