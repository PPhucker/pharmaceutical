<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRegistrationNumberOfEndProductRequest extends FormRequest
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
        $prefix = 'registration_numbers.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'number' => [
                'required',
                'string',
                'max:30',
                Rule::unique('classifier_registration_numbers_of_end_products', 'number')
                    ->whereNotIn('number', $this->input($prefix . 'number')),
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
