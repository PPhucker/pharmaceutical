<?php

namespace App\Http\Controllers\Documents\InvoicesForPayment;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\InvoicesForPayment\Data\Products\StoreInvoiceForPaymentProductRequest;
use App\Http\Requests\Documents\InvoicesForPayment\Data\Products\UpdateInvoiceForPaymentProductRequest;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер продукта в счете на оплату.
 */
class InvoiceForPaymentProductController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoiceForPaymentProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreInvoiceForPaymentProductRequest $request): RedirectResponse
    {
        $validated = $request->validated()['invoice_for_payment_product'];

        $invoiceForPaymentProduct = InvoiceForPaymentProduct::create(
            [
                'user_id' => Auth::user()->id,
                'invoice_for_payment_id' => (int)$validated['invoice_for_payment_id'],
                'product_catalog_id' => (int)$validated['product_catalog_id'],
                'quantity' => (int)$validated['quantity'],
                'price' => (float)$validated['price'],
                'nds' => (float)$validated['nds'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.create.success',
                    ['name' => $invoiceForPaymentProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceForPaymentProductRequest $request
     * @param InvoiceForPaymentProduct              $invoicesForPaymentProduct
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateInvoiceForPaymentProductRequest $request,
        InvoiceForPaymentProduct $invoicesForPaymentProduct
    ) {
        $validated = $request->validated();

        foreach ($validated['invoice_for_payment_products'] as $product) {
            InvoiceForPaymentProduct::find($product['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'quantity' => (int)$product['quantity'],
                        'price' => (float)$product['price'],
                        'nds' => (float)$product['nds'] / 100,
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('documents.invoices_for_payment.data.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoiceForPaymentProduct $invoicesForPaymentProduct
     *
     * @return RedirectResponse
     */
    public function destroy(InvoiceForPaymentProduct $invoicesForPaymentProduct)
    {
        $invoicesForPaymentProduct->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.delete.success',
                    ['name' => $invoicesForPaymentProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param InvoiceForPaymentProduct $invoicesForPaymentProduct
     *
     * @return RedirectResponse
     */
    public function restore(InvoiceForPaymentProduct $invoicesForPaymentProduct)
    {
        $invoicesForPaymentProduct->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.restore.success',
                    ['name' => $invoicesForPaymentProduct->productCatalog->endProduct->short_name]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(InvoiceForPaymentProduct::class, 'invoices_for_payment_product');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return InvoiceForPaymentProductRepository::class;
    }
}
