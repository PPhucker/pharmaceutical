<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfAggregation;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления типов агрегации.
 */
class UpdateTypeOfAggregationRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.types_of_aggregation';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'types_of_aggregation.*.';

        return [
            $prefix . 'original_code' => [
                'required',
                'string',
                'max:10',
            ],
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('classifier_types_of_aggregation', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'code'))
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:20'
            ],
        ];
    }
}
