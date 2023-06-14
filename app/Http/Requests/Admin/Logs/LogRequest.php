<?php

namespace App\Http\Requests\Admin\Logs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LogRequest extends FormRequest
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
            'user' => [
                'nullable',
                'string',
                'max: 100'
            ],
            'action' => [
                'nullable',
                'string',
                'max: 20'
            ],
            'model' => [
                'nullable',
                'string',
                'max: 100'
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
                    'logs.fail',
                    __('logs.fail')
                );
            }
        });
    }
}
