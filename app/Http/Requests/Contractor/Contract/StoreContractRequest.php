<?php

namespace App\Http\Requests\Contractor\Contract;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления договора с контрагентом.
 */
class StoreContractRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.contracts';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'contract.';

        return [
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'number' => [
                'nullable',
                'string',
                'max:20',
            ],
            $prefix . 'date' => [
                'required',
                'date',
            ],
            $prefix . 'comment' => [
                'nullable',
                'string',
                'max:255',
            ],
            $prefix . 'is_valid' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
