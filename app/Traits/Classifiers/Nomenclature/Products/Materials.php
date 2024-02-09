<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\AttachMaterialRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\DetachMaterialRequest;
use App\Models\Classifier\Nomenclature\Materials\Material;
use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use Illuminate\Http\RedirectResponse;

trait Materials
{
    /**
     * @param ProductCatalog        $productCatalog
     * @param AttachMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function attachMaterial(ProductCatalog $productCatalog, AttachMaterialRequest $request)
    {
        $validated = $request->validated()['material'];

        $material = Material::find((int)$validated['id']);

        $productCatalog->attachMaterial($material);

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.create.success',
                    ['name' => $material->name]
                )
            );
    }

    /**
     * @param ProductCatalog        $productCatalog
     * @param DetachMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function detachMaterial(ProductCatalog $productCatalog, DetachMaterialRequest $request)
    {
        $validated = $request->validated()['material'];

        $material = Material::find((int)$validated['id']);

        $productCatalog->detachMaterial($material);

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.delete.success',
                    ['name' => $material->name]
                )
            );
    }
}
