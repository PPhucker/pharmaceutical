<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfEndProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateTypeOfEndProductRequest extends FormRequest
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
        $prefix = 'types_of_end_products.*.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
                Rule::unique('classifier_types_of_end_products', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name'))
            ],
            $prefix . 'color' => [
                'nullable',
                'string',
                'max:7'
            ],
            $prefix . 'id' => [
                'required',
                'numeric'
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
