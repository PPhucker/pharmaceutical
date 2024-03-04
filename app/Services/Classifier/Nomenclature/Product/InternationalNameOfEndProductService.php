<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Services\CrudService;

/**
 * Сервис международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProductService extends CrudService
{
    /**
     * @param EndProductServiceDependencies $endProductServiceDependencies
     */
    public function __construct(EndProductServiceDependencies $endProductServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $endProductServiceDependencies
            ]
        );

        $this->selectedRepo = $this->repositories->internationalName;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $internationalNames = $this->selectedRepo->getAll();

        return compact('internationalNames');
    }
}
