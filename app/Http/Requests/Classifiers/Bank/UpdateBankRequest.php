<?php

namespace App\Http\Requests\Classifiers\Bank;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBankRequest extends FormRequest
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
        $prefix = 'banks.*.';

        return [
            $prefix . 'original_BIC' => [
                'required',
                'string'
            ],
            $prefix . 'BIC' => [
                'required',
                'numeric',
                'digits: 9',
                'distinct',
                Rule::unique('classifier_banks', 'BIC')
                    ->whereNotIn('BIC', $this->input($prefix . 'BIC'))
            ],
            $prefix . 'correspondent_account' => [
                'required',
                'numeric',
                'digits: 20'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max: 120'
            ],
        ];
    }
}
