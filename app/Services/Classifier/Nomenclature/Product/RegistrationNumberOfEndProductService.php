<?php

namespace App\Services\Classifier\Nomenclature\Product;

/**
 * Сервис регистрационного номера готовой продукции.
 */
class RegistrationNumberOfEndProductService extends EndProductRelationService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $registrationNumbers = $this->selectedRepo->getAll();

        return compact('registrationNumbers');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->registrationNumber;
    }
}
