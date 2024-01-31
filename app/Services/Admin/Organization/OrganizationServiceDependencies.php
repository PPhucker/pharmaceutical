<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Contractor\LegalFormRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для OrganizationService.
 */
class OrganizationServiceDependencies extends CoreDependencyService
{
    /**
     * @param OrganizationRepository $organization
     * @param LegalFormRepository    $legalForm
     */
    public function __construct(
        OrganizationRepository $organization,
        LegalFormRepository $legalForm
    ) {
        $this->repositories = compact(
            'organization',
            'legalForm'
        );
    }
}
