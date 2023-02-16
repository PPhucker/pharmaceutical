<?php

namespace App\Http\Requests\Admin\Organizations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreOrganizationRequest extends FormRequest
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
        return [
            'legal_form_type' => [
                'required',
                'string',
                'max:15'
            ],
            'name' => [
                'required',
                'string',
                'max:120'
            ],
            'INN' => [
                'required',
                'numeric',
                'digits_between:10,12',
                Rule::unique('organizations', 'INN'),
            ],
            'OKPO' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('organizations', 'OKPO')
            ],
            'contacts' => [
                'nullable',
                'string',
                'max:120'
            ]
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'contractors.organizations.actions.create.fail',
                    __('fail', ['name' => $this->name])
                );
            }
        });
    }
}
