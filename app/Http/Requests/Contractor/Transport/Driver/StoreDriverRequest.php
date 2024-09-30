<?php

namespace App\Http\Requests\Contractor\Transport\Driver;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления водителя контрагента.
 */
class StoreDriverRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'driver.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
            ],
        ];
    }
}
