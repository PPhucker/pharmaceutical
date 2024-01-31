<?php

namespace App\Http\Requests\Admin\Organization\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
                'max:50'
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

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('contractors.staff.actions.update.fail')
                );
            }
        });
    }
}
