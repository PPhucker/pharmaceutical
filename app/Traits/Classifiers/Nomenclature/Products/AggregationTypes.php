<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\AttachAggregationTypeRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\DetachAggregationTypeRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\UpdateProductQuantityRequest;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Classifiers\Nomenclature\Products\TypeOfAggregation;
use Illuminate\Http\RedirectResponse;

trait AggregationTypes
{
    /**
     * @param EndProduct                   $endProduct
     * @param AttachAggregationTypeRequest $request
     *
     * @return RedirectResponse
     */
    public function attachAggregationType(EndProduct $endProduct, AttachAggregationTypeRequest $request)
    {
        $validated = $request->validated()['aggregation_type'];

        $aggregationType = TypeOfAggregation::find($validated['code']);

        $endProduct->attachAggregationType(
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
     * @param EndProduct                   $endProduct
     * @param DetachAggregationTypeRequest $request
     *
     * @return RedirectResponse
     */
    public function detachAggregationType(EndProduct $endProduct, DetachAggregationTypeRequest $request)
    {
        $validated = $request->validated()['aggregation_type'];

        $aggregationType = TypeOfAggregation::find($validated['code']);

        $endProduct->detachAggregationType($aggregationType);

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
     * @param EndProduct                   $endProduct
     * @param UpdateProductQuantityRequest $request
     *
     * @return RedirectResponse
     */
    public function updateProductQuantity(EndProduct $endProduct, UpdateProductQuantityRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['aggregation_types'] as $aggregationType) {
            $endProduct->aggregationTypes()->syncWithPivotValues(
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
