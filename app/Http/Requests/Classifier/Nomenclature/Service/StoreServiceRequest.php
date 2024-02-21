<?php

namespace App\Http\Requests\Classifier\Nomenclature\Service;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления услуги.
 */
class StoreServiceRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.services';

    protected $action = 'create';

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
