<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateInternationalNameOfEndProductRequest extends FormRequest
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
        $prefix = 'international_names_of_end_products.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
                Rule::unique('classifier_international_names_of_end_products', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name')),
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