<?php

namespace App\Services\Contractor\Bank;

use App\Repositories\Classifier\BankRepository;
use App\Repositories\Contractor\BankAccountDetailRepository;
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
