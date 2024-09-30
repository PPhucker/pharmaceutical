<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления международного непатентованного названия готовой продукции.
 */
class StoreInternationalNameOfEndProductRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'international_name_of_end_product.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max: 60',
                'unique:classifier_international_names_of_end_products,name',
            ],
        ];
    }
}
