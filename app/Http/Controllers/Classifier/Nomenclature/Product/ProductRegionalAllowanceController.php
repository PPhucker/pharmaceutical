<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductRegionalAllowance\StoreProductRegionalAllowanceRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductRegionalAllowance\UpdateProductRegionalAllowanceRequest;
use App\Models\Classifier\Nomenclature\Products\ProductRegionalAllowance;
use App\Repositories\Classifiers\Nomenclature\Products\ProductRegionalAllowanceRepository;
use Auth;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер региональной надбавки готовой продукции.
 */
class ProductRegionalAllowanceController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRegionalAllowanceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProductRegionalAllowanceRequest $request): RedirectResponse
    {
        $validatedAllowance = $request->validated()['product_regional_allowance'];

        ProductRegionalAllowance::create(
            [
                'user_id' => Auth::user()->id,
                'product_catalog_id' => (int)$validatedAllowance['product_catalog_id'],
                'region_id' => (int)$validatedAllowance['region_id'],
                'allowance' => (float)((int)$validatedAllowance['allowance'] / 100),
            ]
        );

        return back()
            ->with(
                'success',
                __(StoreProductRegionalAllowanceRequest::AFTER_VALIDATOR_SUCCESS_KEY_MESSAGE)
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRegionalAllowanceRequest $request
     * @param ProductRegionalAllowance|null         $productRegionalAllowance
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateProductRegionalAllowanceRequest $request,
        ProductRegionalAllowance $productRegionalAllowance = null
    ): RedirectResponse {
        $validated = $request->validated();

        foreach ($validated['product_regional_allowances'] as $validatedAllowance) {
            ProductRegionalAllowance::find((int)$validatedAllowance['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'product_catalog_id' => (int)$validatedAllowance['product_catalog_id'],
                        'region_id' => (int)$validatedAllowance['region_id'],
                        'allowance' => (float)((int)$validatedAllowance['allowance'] / 100),
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __(UpdateProductRegionalAllowanceRequest::AFTER_VALIDATOR_SUCCESS_KEY_MESSAGE)
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return RedirectResponse
     */
    public function destroy(ProductRegionalAllowance $productRegionalAllowance): RedirectResponse
    {
        $productRegionalAllowance->delete();

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.regional_allowances.actions.delete.success')
            );
    }

    /**
     * @param ProductRegionalAllowance $productRegionalAllowance
     *
     * @return RedirectResponse
     */
    public function restore(ProductRegionalAllowance $productRegionalAllowance): RedirectResponse
    {
        $productRegionalAllowance->restore();

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.regional_allowances.actions.restore.success')
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(ProductRegionalAllowance::class, 'product_regional_allowance');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return ProductRegionalAllowanceRepository::class;
    }
}
