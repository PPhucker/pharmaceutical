<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Materials\Material;
use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasMaterials
{
    /**
     * @return BelongsToMany
     */
    public function materials()
    {
        return $this->belongsToMany(
            Material::class,
            'end_products_materials',
            'end_product_id',
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

        Logger::userActionNotice(
            'attach',
            $this,
            [
                'table' => 'end_products_materials',
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
    public function detachMaterial(Material $material)
    {
        $this->materials()->detach(
            $material->id,
            [
                'user_id' => Auth::user()->id
            ]
        );

        Logger::userActionNotice(
            'detach',
            $this,
            [
                'table' => 'end_products_materials',
                'id' => $material->id
            ]
        );

        return $this;
    }

    /**
     * @return HasMaterials
     */
    public function detachAllMaterials()
    {
        $this->materials()->detach();
        return $this;
    }
}
