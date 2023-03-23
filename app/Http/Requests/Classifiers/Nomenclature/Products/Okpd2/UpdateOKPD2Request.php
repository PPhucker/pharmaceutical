<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\Okpd2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateOKPD2Request extends FormRequest
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
        $prefix = 'okpd2.*.';

        return [
            $prefix . 'code' => [
                'required',
                'max:20',
                Rule::unique('classifier_okpd2', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'code'))
            ],
            $prefix . 'original_code' => [
                'required',
                'max:20',
                Rule::unique('classifier_okpd2', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'original_code'))
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
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
