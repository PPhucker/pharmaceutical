<?php

namespace App\Services\Contractor;

use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Contractors\LegalFormRepository;

/**
 * Сервис зависимостей для ContractorService
 */
class ContractorServiceDependencies extends CoreDependencyService
{
    /**
     * @param ContractorRepository   $contractor
     * @param OrganizationRepository $organization
     * @param LegalFormRepository    $legalForm
     */
    public function __construct(
        ContractorRepository $contractor,
        OrganizationRepository $organization,
        LegalFormRepository $legalForm
    ) {
        $this->repositories = compact('contractor', 'organization', 'legalForm');
    }
}
