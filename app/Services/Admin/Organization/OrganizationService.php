<?php

namespace App\Services\Admin\Organization;

use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис организации.
 */
class OrganizationService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param OrganizationServiceDependencies $organizationServiceDependencies
     * @param BankServiceDependencies         $bankServiceDependencies
     */
    public function __construct(
        OrganizationServiceDependencies $organizationServiceDependencies,
        BankServiceDependencies $bankServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $organizationServiceDependencies,
                $bankServiceDependencies
            ]
        );

        $this->selectedRepo = $this->repositories->organization;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $organizations = $this->repositories->organization->getAll(true);

        return compact(
            'organizations'
        );
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function getEditData($model): array
    {
        $organization = $this->repositories->organization->getForEdit($model->id);
        $legalForms = $this->repositories->legalForm->getAll();
        $banks = $this->repositories->bank->getAll();

        $posts = [
            'director' => 'Директор',
            'bookkeeper' => 'Главный бухгалтер',
            'storekeeper' => 'Заведующий складом готовой продукции',
        ];

        return compact(
            [
                'organization',
                'legalForms',
                'banks',
                'posts'
            ]
        );
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        $legalForms = $this->repositories->legalForm->getAll();

        return compact(
            'legalForms'
        );
    }
}
