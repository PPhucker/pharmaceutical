<?php

namespace App\Http\Requests\Contractors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreContractorRequest extends FormRequest
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
                Rule::unique('contractors', 'INN'),
            ],
            'OKPO' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('contractors', 'OKPO')
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
                    'contractors.actions.create.fail',
                    __('fail', ['name' => $this->name])
                );
            }
        });
    }
}
