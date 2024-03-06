<?php

namespace App\Http\Requests\Contractor;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация создания контрагента.
 */
class StoreContractorRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'legal_form_type' => [
                'required',
                'string',
                'max:15',
            ],
            'name' => [
                'required',
                'string',
                'max:120',
            ],
            'INN' => [
                'required',
                'numeric',
                'digits_between:10,12',
                Rule::unique('contractors', 'INN'),
            ],
            'OKPO' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('contractors', 'OKPO')
            ],
            'kpp' => [
                'required',
                'numeric',
                'digits:9',
            ],
            'contacts' => [
                'nullable',
                'string',
                'max:120',
            ],
            'comment' => [
                'nullable',
                'string',
                'max:255',
            ]
        ];
    }
}
