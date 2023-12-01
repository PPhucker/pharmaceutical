<?php

namespace App\Http\Requests\Contractors\BankAccountDetails;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления банковских реквизитов.
 */
class StoreBankAccountDetailRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.bank_account_details';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'bank_account_detail.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric'
            ],
            $prefix . 'bank' => [
                'required',
                'numeric',
                'digits:9'
            ],
            $prefix . 'payment_account.' . $this->input('bank_account_detail.bank') => [
                'required',
                'numeric',
                'digits:20',
            ]
        ];
    }
}
