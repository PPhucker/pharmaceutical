<?php

namespace App\Services\Contractor\Bank;

use App\Repositories\Contractors\Bank\BankAccountDetailRepository;
use App\Repositories\Contractors\Bank\BankRepository;
use App\Services\Contractor\CoreDependencyService;

/**
 * Сервис зависимостей банка контргагента.
 */
class BankServiceDependencies extends CoreDependencyService
{
    /**
     * @param BankRepository              $bank
     * @param BankAccountDetailRepository $accountDetail
     */
    public function __construct(
        BankRepository $bank,
        BankAccountDetailRepository $accountDetail
    ) {
        $this->repositories = compact('bank', 'accountDetail');
    }
}
