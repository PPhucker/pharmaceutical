<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления цены готовой продукции из каталога.
 */
class UpdateProductPriceRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'product_price.';

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
            ],
            $prefix . 'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            $prefix . 'nds' => [
                'nullable',
                'numeric',
                'min:10',
            ],
        ];
    }
}
