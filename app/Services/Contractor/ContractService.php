<?php

namespace App\Services\Contractor;

use App\Repositories\Contractor\ContractRepository;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис договора с контрагентом.
 */
class ContractService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param ContractRepository $contract
     */
    public function __construct(ContractRepository $contract)
    {
        $this->selectedRepo = $contract;
    }
}
