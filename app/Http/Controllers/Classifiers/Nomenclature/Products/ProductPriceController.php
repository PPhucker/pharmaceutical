<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Products;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductPrice\StoreProductPriceRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductPrice\UpdateProductPriceRequest;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use App\Repositories\Classifiers\Nomenclature\Products\ProductPriceRepository;
use Auth;
use Illuminate\Http\RedirectResponse;

class ProductPriceController extends CoreController
{
    protected function getRepository()
    {
        return ProductPriceRepository::class;
    }

    protected function getPolicy()
    {
        $this->authorizeResource(ProductPrice::class, 'product_price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductPriceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProductPriceRequest $request)
    {
        $validated = $request->validated()['product_price'];

        ProductPrice::create(
            [
                'user_id' => Auth::user()->id,
                'product_catalog_id' => (int)$validated['product_catalog_id'],
                'organization_id' => (int)$validated['organization_id'],
                'retail_price' => (float)$validated['retail_price'],
                'trade_price' => (float)$validated['trade_price'],
                'trade_quantity' => (int)$validated['trade_quantity'],
                'nds' => (float)((int)$validated['nds'] / 100),
            ]
        );

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.product_prices.actions.create.success')
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductPriceRequest $request
     * @param ProductPrice|null         $product_price
     *
     * @return RedirectResponse
     */
    public function update(UpdateProductPriceRequest $request, ProductPrice $product_price = null)
    {
        $validated = $request->validated();

        foreach ($validated['product_prices'] as $item) {
            ProductPrice::find((int)$item['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'product_catalog_id' => (int)$item['product_catalog_id'],
                        'organization_id' => (int)$item['organization_id'],
                        'retail_price' => (float)$item['retail_price'],
                        'trade_price' => (float)$item['trade_price'],
                        'trade_quantity' => (int)$item['trade_quantity'],
                        'nds' => (float)((int)$item['nds'] / 100),
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.product_prices.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductPrice $productPrice
     *
     * @return RedirectResponse
     */
    public function destroy(ProductPrice $productPrice)
    {
        $productPrice->delete();

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.product_prices.actions.delete.success')
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param ProductPrice $productPrice
     *
     * @return RedirectResponse
     */
    public function restore(ProductPrice $productPrice)
    {
        $productPrice->restore();

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.product_prices.actions.restore.success')
            );
    }
}