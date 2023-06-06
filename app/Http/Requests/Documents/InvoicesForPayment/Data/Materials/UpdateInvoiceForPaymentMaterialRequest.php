<?php

namespace App\Http\Requests\Documents\InvoicesForPayment\Data\Materials;

use App\Http\Requests\CoreFormRequest;

class UpdateInvoiceForPaymentMaterialRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.invoices_for_payment.data.actions.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'invoice_for_payment_materials.*.';

        return [
            $prefix . 'id' => [
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
            $prefix . 'nds' => [
                'required',
                'numeric',
            ],
            $prefix . 'price' => [
                'required',
                'numeric',
            ],
        ];
    }
}
