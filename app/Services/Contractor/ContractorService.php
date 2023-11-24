<?php

namespace App\Services\Contractor;

use App\Models\Contractors\Contractor;
use App\Services\Contractor\Address\AddressServiceDependencies;
use App\Services\Contractor\Bank\BankServiceDependencies;
use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис контрагента.
 */
class ContractorService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param ContractorServiceDependencies $contractorServiceDependencies
     * @param AddressServiceDependencies    $addressServiceDependencies
     * @param BankServiceDependencies       $bankServiceDependencies
     */
    public function __construct(
        ContractorServiceDependencies $contractorServiceDependencies,
        AddressServiceDependencies $addressServiceDependencies,
        BankServiceDependencies $bankServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $contractorServiceDependencies,
                $addressServiceDependencies,
                $bankServiceDependencies
            ]
        );

        $this->selectedRepo = $this->repositories->contractor;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $contractors = $this->repositories->contractor->getAll(true);
        $organizations = $this->repositories->organization->getAll();

        return compact('contractors', 'organizations');
    }

    /**
     * @param Contractor $model
     *
     * @return array
     */
    public function getEditData($model): array
    {
        $contractor = $this->repositories->contractor->getForEdit($model->id);

        $legalForms = $this->repositories->legalForm->getAll();
        $banks = $this->repositories->bank->getAll();
        $organizations = $this->repositories->organization->getAll(true);
        $regions = $this->repositories->region->getAll();

        return compact(
            'contractor',
            'legalForms',
            'banks',
            'organizations',
            'regions'
        );
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        $legalForms = $this->repositories->legalForm->getAll(true);

        return compact('legalForms');
    }

}
