<?php

namespace App\Traits\Auth;

use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use App\Models\Classifiers\Nomenclature\Services\Service;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNomenclature
{
    /**
     * @return HasMany
     */
    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function catalogProducts()
    {
        return $this->hasMany(ProductCatalog::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'user_id')
            ->withTrashed();
    }
}
