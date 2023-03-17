<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class DetachMaterialRequest extends FormRequest
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

    public function rules()
    {
        $prefix = 'material.';

        return [
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
