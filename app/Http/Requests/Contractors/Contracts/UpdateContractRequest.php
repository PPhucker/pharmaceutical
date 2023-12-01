<?php

namespace App\Http\Requests\Contractors\Contracts;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления договоров с контрагентом.
 */
class UpdateContractRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.contracts';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'contracts.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_id' => [
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
