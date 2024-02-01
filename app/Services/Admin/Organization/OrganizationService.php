<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Classifier\BankRepository;
use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис организации.
 */
class OrganizationService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param OrganizationServiceDependencies $organizationServiceDependencies
     *
     * @throws BindingResolutionException
     */
    public function __construct(
        OrganizationServiceDependencies $organizationServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $organizationServiceDependencies,
            ]
        );

        $this->repositories->bank = app()
            ->make(BankRepository::class);

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
