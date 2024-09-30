<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePackingListRequest extends FormRequest
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
        return [
            'organization_id' => [
                'required',
                'numeric',
            ],
            'organization_place_id' => [
                'required',
                'numeric',
            ],
            'organization_bank_id' => [
                'required',
                'numeric',
            ],
            'contractor_id' => [
                'required',
                'numeric',
            ],
            'contractor_place_id' => [
                'required',
                'numeric',
            ],
            'contractor_bank_id' => [
                'required',
                'numeric',
            ],
            'number' => [
                'required',
                'string',
                'max:10',
            ],
            'date' => [
                'required',
                'date',
            ],
            'director' => [
                'nullable',
                'string',
                'max:60',
            ],
            'bookkeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
            'storekeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
            'invoice_for_payment_product' => [
                'array',
                'required',
            ],
            'invoice_for_payment_product.*.id' => [
                'required',
                'numeric',
            ],
            'invoice_for_payment_product.*.invoice_for_payment_id' => [
                'required',
                'numeric',
            ],
            'invoice_for_payment_product.*.series' => [
                'required',
                'numeric',
                'digits_between:5,7',
            ],
            'invoice_for_payment_product.*.quantity' => [
                function ($attribute, $value, $fail) {
                    $key = (int)mb_substr($attribute, 28, 1);

                    $productCatalogId = $this->input('invoice_for_payment_product.' . $key . '.product_catalog_id');

                    $productCatalog = ProductCatalog::find(
                        $productCatalogId
                    );

                    $quantity = $productCatalog->getQuantityInAggregationType('sscc01');

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
            'invoice_for_payment_product.*.price' => [
                'required',
                'numeric',
            ],
            'invoice_for_payment_product.*.nds' => [
                'required',
                'numeric',
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
                    __('documents.shipment.packing_lists.actions.create.fail')
                );
            }
        });
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $invoiceProducts = [];

        foreach ($this->request->all()['invoice_for_payment_product'] as $key => $product) {
            if (!isset($product['id'])) {
                continue;
            }
            $invoiceProducts[$key] = $product;
        }

        $this->merge(
            [
                'invoice_for_payment_product' => $invoiceProducts
            ]
        );
    }
}
