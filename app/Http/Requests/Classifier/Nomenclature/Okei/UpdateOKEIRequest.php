<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Okei;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateOKEIRequest extends FormRequest
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
        $prefix = 'okei.*.';

        return [
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('classifier_okei', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'code')),
            ],
            $prefix . 'original_code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('classifier_okei', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'original_code')),
            ],
            $prefix . 'unit' => [
                'required',
                'string',
                'max:20',
            ],
            $prefix . 'symbol' => [
                'required',
                'string',
                'max:10'
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
