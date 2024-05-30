<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления записи в каталоге готовой продукции.
 */
class UpdateProductCatalogRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'numeric',
            ],
            'place_of_business_id' => [
                'required',
                'numeric',
            ],
            'GTIN' => [
                'nullable',
                'numeric',
                'digits:14',
            ],
        ];
    }
}