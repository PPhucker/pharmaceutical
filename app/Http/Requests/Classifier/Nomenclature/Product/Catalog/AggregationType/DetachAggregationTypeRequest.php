<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация удаления типа агрегации у готового продукта из каталога.
 */
class DetachAggregationTypeRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'aggregation_type.';

        return [
            $prefix . 'aggregation_type' => [
                'required',
                'string',
                'max:10',
            ],
        ];
    }
}
