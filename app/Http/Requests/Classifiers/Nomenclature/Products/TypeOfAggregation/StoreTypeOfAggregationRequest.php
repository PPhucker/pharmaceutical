<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfAggregation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTypeOfAggregationRequest extends FormRequest
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
        $prefix = 'type_of_aggregation.';

        return [
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                'unique:classifier_types_of_aggregation,code'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:20'
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
