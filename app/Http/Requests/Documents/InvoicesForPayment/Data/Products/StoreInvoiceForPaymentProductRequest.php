<?php

namespace App\Http\Requests\Documents\InvoicesForPayment\Data\Products;

use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Repositories\Classifiers\Nomenclature\Products\ProductCatalogRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
        $prefix = 'invoice_for_payment_products.*.';

        return [
            'invoice_for_payment_id' => [
                'required',
                'numeric',
            ],
            'organization_id' => [
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
                function ($attribute, $value, $fail) {
                    /**
                     * Нужный индекс массива.
                     */
                    $key = (int)substr($attribute, 29, 2);

                    /**
                     * Кол-во продукта в упаковке ssc01.
                     */
                    $quantity = ProductCatalog::find(
                        (int)$this->input('invoice_for_payment_products.' . $key . '.product_catalog_id')
                    )
                        ->getQuantityInAggregationType('sscc01');

                    /**
                     * Если кол-во в счете не кратно количесву в sscc01.
                     */
                    if ((int)$value % $quantity !== 0) {
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
                'min:0',
                'max:100',
            ],
            $prefix . 'allowance' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
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
            }
        });
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        $validated = $this->validated();
        $validated['invoice_for_payment_products'] = $this->input('invoice_for_payment_products');

        $this->merge([
            'mergedValidated' => $validated
        ]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $products = [];

        /**
         * Добавляем в валидацию только выбранную продукцию.
         */
        foreach ($this->input('add_invoice_for_payment_products') as $key => $product) {
            if (count($product) >= 2) {
                $products[$key] = $product;
            }
        }

        /**
         * Цена и НДС для выбранной продукции.
         */
        foreach ($products as $key => $product) {
            $productCatalogRepository = new ProductCatalogRepository();

            $priceList = $productCatalogRepository->getPriceList(
                InvoiceForPayment::find((int)$this->input('invoice_for_payment_id')),
                (int)$product['product_catalog_id'],
                (int)$product['quantity'],
            );

            $products[$key]['price'] = (string)$priceList->get('price');
            $products[$key]['nds'] = (string)$priceList->get('nds');
            $products[$key]['allowance'] = (string)$priceList->get('allowance');
        }

        $this->merge(
            [
                'invoice_for_payment_products' => $products,
            ]
        );
    }
}
