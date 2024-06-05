<?php

namespace App\Traits\Classifier\Nomenclature\Relation\Material;

use App\Models\Classifier\Nomenclature\Material\Material;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Трейт для моделей, связанных с комплектующими.
 */
trait HasMaterials
{
    /**
     * @return BelongsToMany
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(
            Material::class,
            'product_catalog_materials',
            'product_catalog_id',
            'material_id'
        )
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
