<?php

namespace App\Repositories\Admin\Organization;

use App\Models\Admin\Organization\BankAccountDetail;
use App\Repositories\Contractor\Bank\BankAccountDetailRepository as ContractorBankAccountDetailReposytory;

/**
 * Репозиторий банковских реквизитов организации.
 */
class BankAccountDetailRepository extends ContractorBankAccountDetailReposytory
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return BankAccountDetail::class;
    }
}
