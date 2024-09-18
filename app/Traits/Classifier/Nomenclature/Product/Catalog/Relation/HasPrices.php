<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Relation;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice;
use App\Models\Classifier\Nomenclature\Product\Catalog\Price\WholesalePrice;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Трейт цен.
 */
trait HasPrices
{
    /**
     * @return HasOne
     */
    public function retailPrice(): HasOne
    {
        return $this->hasOne(ProductPrice::class, $this->foreign_key)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function wholesalePrices(): HasMany
    {
        return $this->hasMany(WholesalePrice::class, $this->foreign_key)
            ->withTrashed();
    }
}
