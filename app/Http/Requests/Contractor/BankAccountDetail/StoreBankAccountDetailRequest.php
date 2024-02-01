<?php

namespace App\Http\Requests\Contractor\BankAccountDetail;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления банковских реквизитов.
 */
class StoreBankAccountDetailRequest extends CoreFormRequest
{
    protected $action = 'create';

    protected $prefixLocalKey = 'contractors.bank_account_details';
    protected $prefixRuleKey = 'bank_account_detail.';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            $this->prefixRuleKey . 'bank' => [
                'required',
                'numeric',
                'digits:9'
            ],
            $this->prefixRuleKey . 'payment_account.' . $this->input('bank_account_detail.bank') => [
                'required',
                'numeric',
                'digits:20',
            ]
        ];

        return array_merge($rules, $this->getMoreRules());
    }

    /**
     * @return array[]
     */
    protected function getMoreRules(): array
    {
        return [
            $this->prefixRuleKey . 'contractor_id' => [
                'required',
                'numeric',
            ],
        ];
    }
}
