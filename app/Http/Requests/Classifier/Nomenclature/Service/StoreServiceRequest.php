<?php

namespace App\Http\Requests\Classifier\Nomenclature\Service;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления услуги.
 */
class StoreServiceRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'service.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:255',
            ],
            $prefix . 'okei_code' => [
                'required',
                'string',
                'max:10',
            ],
        ];
    }
}
