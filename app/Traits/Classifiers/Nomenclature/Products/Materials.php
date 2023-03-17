<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\AttachMaterialRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\DetachMaterialRequest;
use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use Illuminate\Http\RedirectResponse;
trait Materials
{
    /**
     * @param EndProduct            $endProduct
     * @param AttachMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function attachMaterial(EndProduct $endProduct, AttachMaterialRequest $request)
    {
        $validated = $request->validated()['material'];

        $material = Material::find((int)$validated['id']);

        $endProduct->attachMaterial($material);

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
     * @param EndProduct            $endProduct
     * @param DetachMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function detachMaterial(EndProduct $endProduct, DetachMaterialRequest $request)
    {
        $validated = $request->validated()['material'];

        $material = Material::find((int)$validated['id']);

        $endProduct->detachMaterial($material);

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
