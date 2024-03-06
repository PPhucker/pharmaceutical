<?php

namespace App\Http\Requests\Admin\Organization\Staff;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления нового сотрудника организации.
 */
class StoreStaffRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'staff.';

        return [
            $prefix . 'organization_id' => [
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
                Rule::unique('organizations_staff', 'post')
                    ->where('post', $this->input($prefix . 'post'))
                    ->where(
                        'organization_place_of_business_id',
                        $this->input($prefix . 'organization_place_of_business_id')
                    )
                    ->whereNull('deleted_at'),
            ]
        ];
    }
}
