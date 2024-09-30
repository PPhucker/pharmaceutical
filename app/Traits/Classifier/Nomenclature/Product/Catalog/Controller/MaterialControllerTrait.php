<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Controller;

use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Material\DetachMaterialRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Material\AttachMaterialRequest;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт комплектующих для контроллера каталога готовой продукции.
 */
trait MaterialControllerTrait
{
    /**
     * @param AttachMaterialRequest $request
     * @param ProductCatalog        $productCatalog
     *
     * @return RedirectResponse
     */
    public function attachMaterial(
        AttachMaterialRequest $request,
        ProductCatalog $productCatalog
    ): RedirectResponse {
        $this->service->attachMaterial(
            $productCatalog,
            $request->validated()['material']
        );

        return $this->successRedirect();
    }

    /**
     * @param DetachMaterialRequest $request
     * @param ProductCatalog        $productCatalog
     *
     * @return RedirectResponse
     */
    public function detachMaterial(
        DetachMaterialRequest $request,
        ProductCatalog $productCatalog
    ): RedirectResponse {
        $this->service->detachMaterial(
            $productCatalog,
            $request->validated()['material']
        );

        return $this->successRedirect();
    }
}
