<?php

namespace App\Http\Requests\Classifiers\Bank;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBankRequest extends FormRequest
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
        $prefix = 'bank.';

        return [
            $prefix . 'BIC' => [
                'required',
                'numeric',
                'digits: 9',
                'unique:classifier_banks,BIC'
            ],
            $prefix . 'correspondent_account' => [
                'required',
                'numeric',
                'digits: 20'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max: 120'
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('classifiers.fail')
                );
            }
        });
    }
}
