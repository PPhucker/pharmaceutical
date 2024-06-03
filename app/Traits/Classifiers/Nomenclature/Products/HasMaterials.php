<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Material\Material;
use Auth;
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

    /**
     * @param Material $material
     *
     * @return $this
     */
    public function attachMaterial(Material $material)
    {
        $this->materials()->attach(
            $material->id,
            [
                'user_id' => Auth::user()->id,
            ]
        );

        (new Logger())->userActionNotice(
            'attach',
            $this,
            [
                'table' => 'product_catalog_materials',
                'id' => $material->id
            ]
        );

        return $this;
    }

    /**
     * @param Material $material
     *
     * @return $this
     */
    public function detachMaterial(Material $material): HasMaterials
    {
        $this->materials()->detach(
            $material->id,
            [
                'user_id' => Auth::user()->id
            ]
        );

        (new Logger())->userActionNotice(
            'detach',
            $this,
            [
                'table' => 'product_catalog_materials',
                'id' => $material->id
            ]
        );

        return $this;
    }

    /**
     * @return HasMaterials
     */
    public function detachAllMaterials(): HasMaterials
    {
        $this->materials()->detach();
        return $this;
    }
}
