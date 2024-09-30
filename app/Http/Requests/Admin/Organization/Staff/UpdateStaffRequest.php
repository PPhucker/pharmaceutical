<?php

namespace App\Http\Requests\Admin\Organization\Staff;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления сотрудников организации.
 */
class UpdateStaffRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'staff.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_place_of_business_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:50',
            ],
            $prefix . 'post' => [
                'required',
                'string',
                'max:50',
            ]
        ];
    }
}
