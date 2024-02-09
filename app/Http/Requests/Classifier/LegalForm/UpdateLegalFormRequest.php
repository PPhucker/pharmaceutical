<?php

namespace App\Http\Requests\Classifiers\LegalForm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateLegalFormRequest extends FormRequest
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
        $prefix = 'legal_forms';

        return [
            $prefix . '.*.original_abbreviation' => [
                'required',
                'string',
            ],
            $prefix . '.*.abbreviation' => [
                'required',
                'string',
                'max: 15',
                'distinct',
                Rule::unique('classifier_legal_forms', 'abbreviation')
                    ->whereNotIn('abbreviation', $this->input($prefix . '.*.abbreviation'))
            ],
            $prefix . '.*.decoding' => [
                'nullable',
                'string',
                'max: 150'
            ]
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
