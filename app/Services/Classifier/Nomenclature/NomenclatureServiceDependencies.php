<?php

namespace App\Services\Classifier\Nomenclature;

use App\Repositories\Classifier\Nomenclature\OKEIRepository;
use App\Repositories\Classifier\Nomenclature\ServiceRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для номенклатуры.
 */
class NomenclatureServiceDependencies extends CoreDependencyService
{
    /**
     * @param OKEIRepository    $okei
     * @param ServiceRepository $service
     */
    public function __construct(
        OKEIRepository $okei,
        ServiceRepository $service
    ) {
        $this->repositories = compact(
            'okei',
            'service'
        );
    }
}
