<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления типов готовой продукции.
 */
class UpdateTypeOfEndProductRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'types_of_end_products.*.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
                Rule::unique('classifier_types_of_end_products', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name')),
            ],
            $prefix . 'color' => [
                'nullable',
                'string',
                'max:7',
            ],
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
        ];
    }
}
