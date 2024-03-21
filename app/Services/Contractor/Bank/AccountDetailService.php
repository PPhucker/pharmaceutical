<?php

namespace App\Services\Contractor\Bank;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис банковских реквзитов контрагента.
 */
class AccountDetailService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param BankServiceDependencies $bankServiceDependencies
     */
    public function __construct(BankServiceDependencies $bankServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $bankServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->accountDetail;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }
}
