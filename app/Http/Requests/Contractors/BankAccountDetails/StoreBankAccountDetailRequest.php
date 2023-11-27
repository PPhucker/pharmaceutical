<?php

namespace App\Http\Requests\Contractors\BankAccountDetails;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления банковских реквизитов.
 */
class StoreBankAccountDetailRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.bank_account_details.actions.create.fail';

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

    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        $bic = $this->input('bank_account_detail.bank');

        $this->merge([
            'bank_account_detail' => [
                'contractor_id' => $this->input('bank_account_detail.contractor_id'),
                'bank' => $bic,
                'payment_account' => [
                    $bic => $this->input("bank_account_detail.payment_account.$bic")
                ],
            ]
        ]);
    }
}
