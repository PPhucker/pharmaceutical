<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Materials\TypeOfMaterial;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateTypeOfMaterialRequest extends FormRequest
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
        $prefix = 'types_of_materials.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('classifier_types_of_materials', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name'))
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
