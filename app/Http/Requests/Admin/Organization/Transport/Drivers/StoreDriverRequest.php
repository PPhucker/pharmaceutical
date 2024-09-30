<?php

namespace App\Http\Requests\Admin\Organization\Transport\Drivers;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления водителя организации.
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
            $prefix . 'organization_id' => [
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
