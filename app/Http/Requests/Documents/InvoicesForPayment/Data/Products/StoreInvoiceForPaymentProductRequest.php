<?php

namespace App\Http\Requests\Documents\InvoicesForPayment\Data\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreInvoiceForPaymentProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productCatalog = ProductCatalog::find(
            (int)$this->input('invoice_for_payment_product.product_catalog_id')
        );

        $quantity = $productCatalog->getQuantityInAggregationType('sscc01');

        $prefix = 'invoice_for_payment_product.';

        return [
            $prefix . 'invoice_for_payment_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:1',
                static function ($attribute, $value, $fail) use ($quantity) {
                    if ($value % $quantity !== 0) {
                        $fail(
                            __(
                                'documents.invoices_for_payment.data.fails.quantity',
                                ['quantity' => $quantity]
                            )
                        );
                    }
                },
            ],
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('documents.invoices_for_payment.data.actions.create.fail')
                );
            }
        });
    }
}
