<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\EndProduct;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления конечного продукта.
 */
class StoreEndProductRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type_id' => [
                'required',
                'numeric',
            ],
            'international_name_id' => [
                'required',
                'numeric',
            ],
            'registration_number_id' => [
                'nullable',
                'numeric',
            ],
            'okei_code' => [
                'required',
                'string',
                'max:10',
            ],
            'okpd2_code' => [
                'required',
                'string',
                'max:20',
            ],
            'short_name' => [
                'required',
                'string',
                'max:50',
            ],
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
            'marking' => [
                'required',
                'bool',
            ],
            'best_before_date' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
}
