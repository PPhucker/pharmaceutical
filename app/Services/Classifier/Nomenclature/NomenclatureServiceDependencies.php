<?php

namespace App\Services\Classifier\Nomenclature;

use App\Repositories\Classifier\Nomenclature\OKEIRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для номенклатуры.
 */
class NomenclatureServiceDependencies extends CoreDependencyService
{
    /**
     * @param OKEIRepository $okei
     */
    public function __construct(
        OKEIRepository $okei
    ) {
        $this->repositories = compact(
            'okei'
        );
    }
}
