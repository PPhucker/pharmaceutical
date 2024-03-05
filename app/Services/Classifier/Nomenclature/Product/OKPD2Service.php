<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Services\CrudService;

/**
 * Сервис классификатора ОКПД2.
 */
class OKPD2Service extends CrudService
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

        $this->selectedRepo = $this->repositories->okpd2;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $okpd2Classifier = $this->selectedRepo->getAll();

        return compact('okpd2Classifier');
    }
}
