<?php

namespace App\Services\Classifier;

use App\Repositories\Classifier\BankRepository;
use App\Repositories\Classifier\LegalFormRepository;
use App\Repositories\Classifier\RegionRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для основных классификаторов.
 */
class ClassifierServiceDependencies extends CoreDependencyService
{
    /**
     * @param BankRepository      $bank
     * @param LegalFormRepository $legalForm
     * @param RegionRepository    $region
     */
    public function __construct(
        BankRepository $bank,
        LegalFormRepository $legalForm,
        RegionRepository $region
    ) {
        $this->repositories = compact(
            'bank',
            'legalForm',
            'region'
        );
    }
}
