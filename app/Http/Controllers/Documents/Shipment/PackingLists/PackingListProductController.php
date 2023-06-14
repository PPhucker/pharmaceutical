<?php

namespace App\Http\Controllers\Documents\Shipment\PackingLists;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\PackingLists\Data\Products\StorePackingListProductRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\Data\Products\UpdatePackingListProductRequest;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PackingListProductController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePackingListProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePackingListProductRequest $request)
    {
        $validated = $request->validated()['packing_list_product'];

        $invoiceForPaymentProduct = InvoiceForPaymentProduct::find((int)$validated['invoice_for_payment_product_id']);

        PackingListProduct::create(
            [
                'user_id' => Auth::user()->id,
                'packing_list_id' => (int)$validated['packing_list_id'],
                'invoice_for_payment_id' => $invoiceForPaymentProduct->invoiceForPayment->id,
                'product_id' => $invoiceForPaymentProduct->productCatalog->id,
                'quantity' => (int)$validated['quantity'],
                'series' => $validated['series'],
                'price' => $invoiceForPaymentProduct->price,
                'nds' => $invoiceForPaymentProduct->nds,
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.data.actions.create.success',
                    ['name' => $invoiceForPaymentProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePackingListProductRequest $request
     * @param PackingListProduct              $packingListProduct
     *
     * @return RedirectResponse
     */
    public function update(UpdatePackingListProductRequest $request, PackingListProduct $packingListProduct)
    {
        $validated = $request->validated();

        foreach ($validated['packing_list_products'] as $validated) {
            PackingListProduct::find((int)$validated['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'quantity' => (int)$validated['quantity'],
                        'series' => $validated['series'],
                        'price' => (float)$validated['price'],
                        'nds' => (int)$validated['nds'] / 100,
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('documents.shipment.packing_lists.data.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return RedirectResponse
     */
    public function destroy(PackingListProduct $packingListProduct)
    {
        $packingListProduct->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.data.actions.delete.success',
                    ['name' => $packingListProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return RedirectResponse
     */
    public function restore(PackingListProduct $packingListProduct)
    {
        $packingListProduct->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.data.actions.restore.success',
                    ['name' => $packingListProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(PackingListProduct::class, 'packing_list_product');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return PackingListProductRepository::class;
    }
}
