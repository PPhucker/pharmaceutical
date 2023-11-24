<?php

namespace App\Services\Contractor\Bank;

use App\Repositories\Contractors\Bank\BankRepository;
use App\Services\Contractor\CoreDependencyService;

/**
 * Сервис зависимостей банка контргагента.
 */
class BankServiceDependencies extends CoreDependencyService
{
    /**
     * @param BankRepository $bank
     */
    public function __construct(
        BankRepository $bank
    ) {
        $this->repositories = compact('bank');
    }
}
