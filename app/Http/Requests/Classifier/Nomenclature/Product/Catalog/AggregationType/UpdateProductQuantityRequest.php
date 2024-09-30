<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления количества готовой продукции, содержащейся в типе агрегации.
 */
class UpdateProductQuantityRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'aggregation_types.*.';

        return [
            $prefix . 'aggregation_type' => [
                'required',
                'string',
                'max:10'
            ],
            $prefix . 'product_quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
        ];
    }
}
