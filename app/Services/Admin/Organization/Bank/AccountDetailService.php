<?php

namespace App\Services\Admin\Organization\Bank;

use App\Repositories\Admin\Organization\BankAccountDetailRepository;
use App\Services\Contractor\Bank\AccountDetailService as ContractorAccountDetailService;
use App\Services\Contractor\Bank\BankServiceDependencies;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис банковских реквизитов организации.
 */
class AccountDetailService extends ContractorAccountDetailService
{
    /**
     * @param BankServiceDependencies $bankServiceDependencies
     *
     * @throws BindingResolutionException
     */
    public function __construct(BankServiceDependencies $bankServiceDependencies)
    {
        parent::__construct($bankServiceDependencies);

        $this->repositories->accountDetail = app()
            ->make(BankAccountDetailRepository::class);

        $this->selectedRepo = $this->repositories->accountDetail;
    }
}
