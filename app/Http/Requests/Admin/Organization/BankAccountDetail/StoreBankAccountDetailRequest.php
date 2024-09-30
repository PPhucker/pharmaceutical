<?php

namespace App\Http\Requests\Admin\Organization\BankAccountDetail;

use App\Http\Requests\Contractor\BankAccountDetail\StoreBankAccountDetailRequest
    as ContractorStoreBankAccountDetailRequest;

/**
 * Валидация добавления банковских реквизитов орагнизации.
 */
class StoreBankAccountDetailRequest extends ContractorStoreBankAccountDetailRequest
{
    /**
     * @return array[]
     */
    protected function getMoreRules(): array
    {
        return [
            $this->prefixRuleKey . 'organization_id' => [
                'required',
                'numeric',
            ],
        ];
    }
}
