<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\AttachAggregationTypeRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\DetachAggregationTypeRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\UpdateProductQuantityRequest;
use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use App\Models\Classifier\Nomenclature\Products\TypeOfAggregation;
use Illuminate\Http\RedirectResponse;

trait AggregationTypes
{
    /**
     * @param ProductCatalog               $productCatalog
     * @param AttachAggregationTypeRequest $request
     *
     * @return RedirectResponse
     */
    public function attachAggregationType(ProductCatalog $productCatalog, AttachAggregationTypeRequest $request)
    {
        $validated = $request->validated()['aggregation_type'];

        $aggregationType = TypeOfAggregation::find($validated['code']);

        $productCatalog->attachAggregationType(
            $aggregationType,
            (int)$validated['product_quantity']
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.types_of_aggregation.actions.create.success',
                    ['name' => $aggregationType->name]
                )
            );
    }

    /**
     * @param ProductCatalog               $productCatalog
     * @param DetachAggregationTypeRequest $request
     *
     * @return RedirectResponse
     */
    public function detachAggregationType(ProductCatalog $productCatalog, DetachAggregationTypeRequest $request)
    {
        $validated = $request->validated()['aggregation_type'];

        $aggregationType = TypeOfAggregation::find($validated['code']);

        $productCatalog->detachAggregationType($aggregationType);

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.types_of_aggregation.actions.delete.success',
                    ['name' => $aggregationType->name]
                )
            );
    }

    /**
     * @param ProductCatalog               $productCatalog
     * @param UpdateProductQuantityRequest $request
     *
     * @return RedirectResponse
     */
    public function updateProductQuantity(ProductCatalog $productCatalog, UpdateProductQuantityRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['aggregation_types'] as $aggregationType) {
            $productCatalog->aggregationTypes()->syncWithPivotValues(
                $aggregationType['code'],
                [
                    'product_quantity' => (int)$aggregationType['product_quantity'],
                ],
                false
            );
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.types_of_aggregation.actions.update.success')
            );
    }
}
