<?php

namespace App\Http\Requests\Admin\Organization;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления новой организации.
 */
class StoreOrganizationRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.organizations';

    protected $action = 'create';

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
                'max:15'
            ],
            'name' => [
                'required',
                'string',
                'max:120'
            ],
            'INN' => [
                'required',
                'numeric',
                'digits_between:10,12',
                Rule::unique('organizations', 'INN'),
            ],
            'kpp' => [
                'required',
                'numeric',
                'digits:9',
            ],
            'OKPO' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('organizations', 'OKPO')
            ],
            'contacts' => [
                'nullable',
                'string',
                'max:120'
            ]
        ];
    }
}
