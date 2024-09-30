<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления цены готовой продукции из каталога.
 */
class StoreProductPriceRequest extends CoreFormRequest
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
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'price' => [
                'required',
                'numeric',
                'min:1',
            ],
            $prefix . 'nds' => [
                'required',
                'numeric',
                'min:10',
            ],
        ];
    }
}
