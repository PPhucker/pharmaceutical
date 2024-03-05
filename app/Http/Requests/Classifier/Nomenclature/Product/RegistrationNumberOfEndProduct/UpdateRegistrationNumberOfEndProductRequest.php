<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления классификатора регистрационных номеров готовой продукции.
 */
class UpdateRegistrationNumberOfEndProductRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.registration_numbers';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'registration_numbers.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'number' => [
                'required',
                'string',
                'max:30',
                Rule::unique('classifier_registration_numbers_of_end_products', 'number')
                    ->whereNotIn('number', $this->input($prefix . 'number')),
            ],
        ];
    }
}
