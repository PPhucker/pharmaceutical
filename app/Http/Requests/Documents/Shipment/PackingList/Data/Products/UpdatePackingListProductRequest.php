<?php

namespace App\Http\Requests\Documents\Shipment\PackingList\Data\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdatePackingListProductRequest extends FormRequest
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
        $prefix = 'packing_list_products.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) use ($prefix) {
                    $key = (int)mb_substr($attribute, 22, 1);

                    $packingListProduct = PackingListProduct::find((int)$this->input($prefix . 'id')[$key]);

                    $productCatalog = ProductCatalog::find(
                        $packingListProduct->product_id
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
            $prefix . 'series' => [
                'required',
                'numeric',
                'digits_between:5,7',
            ],
            $prefix . 'price' => [
                'required',
                'numeric',
                'min:1',
            ],
            $prefix . 'nds' => [
                'required',
                'numeric',
                'min:1',
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
                    __('documents.shipment.packing_lists.data.actions.update.fail')
                );
            }
        });
    }
}
