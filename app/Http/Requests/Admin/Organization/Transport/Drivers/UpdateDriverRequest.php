<?php

namespace App\Http\Requests\Admin\Organization\Transport\Drivers;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления водителей организации.
 */
class UpdateDriverRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.drivers';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'drivers.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
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
