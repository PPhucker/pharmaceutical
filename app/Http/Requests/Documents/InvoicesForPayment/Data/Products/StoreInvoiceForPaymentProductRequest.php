<?php

namespace App\Http\Requests\Documents\InvoicesForPayment\Data\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Repositories\Classifiers\Nomenclature\Products\ProductCatalogRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

/**
 * Валидация добавления продукта в счет на оплату.
 */
class StoreInvoiceForPaymentProductRequest extends FormRequest
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
        $quantity = ProductCatalog::find(
            (int)$this->input(
                'invoice_for_payment_product.product_catalog_id'
            )
        )
            ->getQuantityInAggregationType('sscc01');

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
            $prefix . 'price' => [
                'required',
                'numeric',
                static function ($attribute, $value, $fail) {
                    if ((float)$value <= 0) {
                        $fail(
                            __('documents.invoices_for_payment.data.fails.price')
                        );
                    }
                },
            ],
            $prefix . 'nds' => [
                'required',
                'numeric',
                static function ($attribute, $value, $fail) {
                    if ((float)$value <= 0) {
                        $fail(
                            __('documents.invoices_for_payment.data.fails.nds')
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
     * @throws ValidationException
     */
    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('documents.invoices_for_payment.data.actions.create.fail')
                );
                $validator->errors()->add(
                    'alert-errors',
                    __('documents.invoices_for_payment.data.fails.price_list')
                );
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $productCatalogRepository = new ProductCatalogRepository();

        $priceList = $productCatalogRepository->getPriceList(
            (int)$this->input('organization_id'),
            (int)$this->input('invoice_for_payment_product.product_catalog_id'),
            (int)$this->input('invoice_for_payment_product.quantity'),
        );

        $this->merge(
            [
                'invoice_for_payment_product' => array_merge(
                    $this->input('invoice_for_payment_product'),
                    [
                        'price' => (string)$priceList->get('price'),
                        'nds' => (string)$priceList->get('nds'),
                    ]
                ),
            ]
        );
    }
}
