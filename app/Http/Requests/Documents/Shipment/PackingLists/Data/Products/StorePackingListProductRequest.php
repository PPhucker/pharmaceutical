<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists\Data\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * Валидация добавления продукта в товарную накладную.
 */
class StorePackingListProductRequest extends FormRequest
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
        $prefix = 'packing_list_product.';

        return [
            $prefix . 'packing_list_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'invoice_for_payment_product_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) use ($prefix) {
                    $invoiceProduct = InvoiceForPaymentProduct::find(
                        (int)$this->input($prefix . 'invoice_for_payment_product_id')
                    );

                    $productCatalog = ProductCatalog::find(
                        $invoiceProduct->productCatalog->id
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
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $packingListId = (int)$this->input('packing_list_product.packing_list_id');

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
                    __('documents.shipment.packing_lists.data.actions.create.fail')
                );
            }
        });
    }
}
