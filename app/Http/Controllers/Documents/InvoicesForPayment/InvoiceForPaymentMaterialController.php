<?php

namespace App\Http\Controllers\Documents\InvoicesForPayment;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\InvoicesForPayment\Data\Materials\StoreInvoiceForPaymentMaterialRequest;
use App\Http\Requests\Documents\InvoicesForPayment\Data\Materials\UpdateInvoiceForPaymentMaterialRequest;
use App\Models\Classifier\Nomenclature\Material\Material;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentMaterialRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class InvoiceForPaymentMaterialController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoiceForPaymentMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreInvoiceForPaymentMaterialRequest $request)
    {
        $validated = $request->validated()['invoice_for_payment_material'];

        $material = Material::find((int)$validated['material_id']);

        InvoiceForPaymentMaterial::create(
            [
                'user_id' => Auth::user()->id,
                'invoice_for_payment_id' => (int)$validated['invoice_for_payment_id'],
                'material_id' => $material->id,
                'quantity' => (int)$validated['quantity'],
                'price' => (float)$material->price,
                'nds' => (float)$material->nds,
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.create.success',
                    ['name' => $material->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceForPaymentMaterialRequest $request
     * @param InvoiceForPaymentMaterial|null         $invoices_for_payment_material
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateInvoiceForPaymentMaterialRequest $request,
        InvoiceForPaymentMaterial $invoices_for_payment_material = null
    ) {
        $validated = $request->validated();

        foreach ($validated['invoice_for_payment_materials'] as $validatedMaterial) {
            InvoiceForPaymentMaterial::find($validatedMaterial['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'quantity' => (int)$validatedMaterial['quantity'],
                        'price' => (float)$validatedMaterial['price'],
                        'nds' => (float)((int)$validatedMaterial['nds'] / 100),
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
     * @param InvoiceForPaymentMaterial $invoicesForPaymentMaterial
     *
     * @return RedirectResponse
     */
    public function destroy(InvoiceForPaymentMaterial $invoicesForPaymentMaterial)
    {
        $invoicesForPaymentMaterial->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.delete.success',
                    ['name' => $invoicesForPaymentMaterial->material->name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param InvoiceForPaymentMaterial $invoicesForPaymentMaterial
     *
     * @return RedirectResponse
     */
    public function restore(InvoiceForPaymentMaterial $invoicesForPaymentMaterial)
    {
        $invoicesForPaymentMaterial->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.data.actions.restore.success',
                    ['name' => $invoicesForPaymentMaterial->material->name]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(InvoiceForPaymentMaterial::class, 'invoices_for_payment_material');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return InvoiceForPaymentMaterialRepository::class;
    }
}
