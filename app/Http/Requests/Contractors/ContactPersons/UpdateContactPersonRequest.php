<?php

namespace App\Http\Requests\Contractors\ContactPersons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateContactPersonRequest extends FormRequest
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
        $prefix = 'contact_persons.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],

            $prefix . 'name' => [
                'required',
                'string',
                'max:50'
            ],
            $prefix . 'post' => [
                'nullable',
                'string',
                'max:50',
            ],
            $prefix . 'phone' => [
                'nullable',
                'string',
                'max: 15'
            ],
            $prefix . 'email' => [
                'nullable',
                'email',
            ],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('contractors.contact_persons.actions.update.fail')
                );
            }
        });
    }
}
