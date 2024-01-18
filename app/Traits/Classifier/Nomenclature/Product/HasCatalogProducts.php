<?php

namespace App\Traits\Classifier\Nomenclature\Product;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
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