<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Materials;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateMaterialRequest extends FormRequest
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
            'type_id' => [
                'required',
                'numeric'
            ],
            'okei_code' => [
                'required',
                'string',
                'max:10'
            ],
            'name' => [
                'required',
                'string',
                'max:150'
            ],
            'price' => [
                'numeric',
                'nullable',
            ],
            'nds' => [
                'numeric',
                'nullable',
                'max:100'
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
