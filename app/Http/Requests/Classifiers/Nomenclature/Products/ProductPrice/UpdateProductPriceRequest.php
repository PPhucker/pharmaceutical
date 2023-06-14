<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\ProductPrice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateProductPriceRequest extends FormRequest
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
        $prefix = 'product_prices.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_id' => [
                'required',
                'numeric',
                Rule::unique('product_prices', 'organization_id')
                    ->where('organization_id', $this->input($prefix . 'organization_id'))
                    ->whereNotIn('organization_id', $this->input($prefix . 'organization_id')),
            ],
            $prefix . 'retail_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            $prefix . 'trade_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            $prefix . 'nds' => [
                'nullable',
                'numeric',
                'min:10',
            ],
            $prefix . 'trade_quantity' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
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
                    __('classifiers.nomenclature.products.product_prices.actions.update.fail')
                );
            }
        });
    }
}
