<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfAggregation;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового типа агрегации.
 */
class StoreTypeOfAggregationRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'type_of_aggregation.';

        return [
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                'unique:classifier_types_of_aggregation,code',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:20',
            ],
        ];
    }
}
