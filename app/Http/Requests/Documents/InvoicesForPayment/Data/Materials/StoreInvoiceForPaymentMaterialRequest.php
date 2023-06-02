<?php

namespace App\Http\Requests\Documents\InvoicesForPayment\Data\Materials;

use App\Http\Requests\CoreFormRequest;

class StoreInvoiceForPaymentMaterialRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.invoices_for_payment.data.actions.create.fail';

    public function rules()
    {
        $prefix = 'invoice_for_payment_material.';

        return [
            $prefix . 'invoice_for_payment_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'material_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
}
