<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления оптовой цены готовой продукции.
 */
class StoreWholesalePriceRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'wholesale_price.';

        return [
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'wholesale_price' => [
                'required',
                'numeric',
                'min:1',
            ],
            $prefix . 'wholesale_quantity' => [
                'required',
                'numeric',
                'min:10',
            ],
        ];
    }
}
