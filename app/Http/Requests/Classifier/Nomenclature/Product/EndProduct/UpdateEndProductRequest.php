<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateEndProductRequest extends FormRequest
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
            'id' => [
                'required',
                'numeric'
            ],
            'type_id' => [
                'required',
                'numeric',
            ],
            'international_name_id' => [
                'required',
                'numeric'
            ],
            'registration_number_id' => [
                'nullable',
                'numeric',
            ],
            'okei_code' => [
                'required',
                'string',
                'max:10',
            ],
            'okpd2_code' => [
                'required',
                'string',
                'max:20'
            ],
            'short_name' => [
                'required',
                'string',
                'max:50',
            ],
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
            'marking' => [
                'required',
                'bool',
            ],
            'best_before_date' => [
                'required',
                'numeric',
                'min:1'
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
