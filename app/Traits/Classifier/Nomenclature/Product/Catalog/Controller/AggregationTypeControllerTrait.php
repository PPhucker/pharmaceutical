<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Controller;


use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType\AttachAggregationTypeRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType\DetachAggregationTypeRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType\UpdateProductQuantityRequest;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use Illuminate\Http\RedirectResponse;

/**
 *
 */
trait AggregationTypeControllerTrait
{
    /**
     * @param AttachAggregationTypeRequest $request
     * @param ProductCatalog               $productCatalog
     *
     * @return RedirectResponse
     */
    public function attachAggregationType(
        AttachAggregationTypeRequest $request,
        ProductCatalog $productCatalog
    ): RedirectResponse {
        $this->service->attachAggregationType(
            $productCatalog,
            $request->validated()['product_catalog_types_of_aggregation']
        );

        return $this->successRedirect();
    }

    /**
     * @param DetachAggregationTypeRequest $request
     * @param ProductCatalog               $productCatalog
     *
     * @return RedirectResponse
     */
    public function detachAggregationType(
        DetachAggregationTypeRequest $request,
        ProductCatalog $productCatalog
    ): RedirectResponse {
        $this->service->detachAggregationType(
            $productCatalog,
            $request->validated()['aggregation_type']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateProductQuantityRequest $request
     * @param ProductCatalog               $productCatalog
     *
     * @return RedirectResponse
     */
    public function updateAggregationTypeProductQuantity(
        UpdateProductQuantityRequest $request,
        ProductCatalog $productCatalog
    ): RedirectResponse {
        $this->service->updateAggregationTypeProductQuantity(
            $productCatalog,
            $request->validated()['aggregation_types']
        );

        return $this->successRedirect();
    }
}
