<?php

namespace App\Services\Contractor\Bank;

use App\Repositories\Contractor\Bank\BankAccountDetailRepository;
use App\Repositories\Contractor\Bank\BankRepository;
use App\Services\CoreDependencyService;

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
