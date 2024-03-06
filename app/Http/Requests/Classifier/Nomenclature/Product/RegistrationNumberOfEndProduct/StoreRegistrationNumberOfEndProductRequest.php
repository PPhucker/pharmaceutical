<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления регистрационного номера готовой продукции.
 */
class StoreRegistrationNumberOfEndProductRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'registration_number.';

        return [
            $prefix . 'number' => [
                'required',
                'string',
                'max:30',
                'unique:classifier_registration_numbers_of_end_products,number',
            ],
        ];
    }
}
