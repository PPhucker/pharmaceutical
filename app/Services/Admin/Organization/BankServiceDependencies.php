<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Admin\Organization\BankAccountDetailRepository;
use App\Repositories\Contractor\Bank\BankRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей банка организации.
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
        $this->repositories = compact(
            'bank',
            'accountDetail'
        );
    }
}
