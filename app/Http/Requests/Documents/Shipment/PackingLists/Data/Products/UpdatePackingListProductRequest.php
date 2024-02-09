<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists\Data\Products;

use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления продукции товарной накладной.
 */
class UpdatePackingListProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'packing_list_products.*.';

        return [
            'document_id' => [
                'required',
                'numeric',
            ],
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
    protected function withValidator(Validator $validator): void
    {
        $packingListId = (int)$this->input('document_id');

        $validator->after(function ($validator) use ($packingListId) {
            if (PackingList::find($packingListId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.packing_lists.data.actions.update.fail')
                );
            }
        });
    }
}
