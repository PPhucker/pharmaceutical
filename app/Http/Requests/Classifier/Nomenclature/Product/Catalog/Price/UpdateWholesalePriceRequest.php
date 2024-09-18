<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления оптовых цен готовой продукции.
 */
class UpdateWholesalePriceRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'wholesale_prices.*.';

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
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:10',
            ],
        ];
    }
}
