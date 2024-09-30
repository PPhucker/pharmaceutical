<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Admin\Organization\StaffRepository;
use App\Repositories\Classifier\LegalFormRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для OrganizationService.
 */
class OrganizationServiceDependencies extends CoreDependencyService
{
    /**
     * @param OrganizationRepository $organization
     * @param LegalFormRepository    $legalForm
     * @param StaffRepository        $staff
     */
    public function __construct(
        OrganizationRepository $organization,
        LegalFormRepository $legalForm,
        StaffRepository $staff
    ) {
        $this->repositories = compact(
            'organization',
            'legalForm',
            'staff'
        );
    }
}
