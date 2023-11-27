<?php

namespace App\Http\Requests\Contractors\BankAccountDetails;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления банковских реквизитов контргента.
 */
class UpdateBankAccountDetailRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.bank_account_details.actions.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'bank_account_details.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'payment_account' => [
                'required',
                'numeric',
                'digits:20'
            ]
        ];
    }
}
