<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Relation;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductRegionalAllowance;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRegionalAllowances
{
    /**
     * @return HasMany
     */
    public function regionalAllowances(): HasMany
    {
        return $this->hasMany(ProductRegionalAllowance::class, $this->foreign_key);
    }
}
