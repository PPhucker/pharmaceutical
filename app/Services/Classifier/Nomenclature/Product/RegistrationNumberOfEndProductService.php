<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Services\CrudService;

/**
 * Сервис регистрационного номера готовой продукции.
 */
class RegistrationNumberOfEndProductService extends CrudService
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

        $this->selectedRepo = $this->repositories->registrationNumber;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $registrationNumbers = $this->selectedRepo->getAll();

        return compact('registrationNumbers');
    }
}
