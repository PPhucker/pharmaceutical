<?php

namespace App\Http\Requests\Classifier\Nomenclature\Service;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления услуг.
 */
class UpdateServiceRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'services.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
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
