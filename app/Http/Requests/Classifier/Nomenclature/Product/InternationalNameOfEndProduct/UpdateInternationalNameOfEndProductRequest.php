<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления международных непатентованных названий готовой продукции.
 */
class UpdateInternationalNameOfEndProductRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.international_names_of_end_products';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'international_names_of_end_products.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
                Rule::unique('classifier_international_names_of_end_products', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name')),
            ],
        ];
    }
}
