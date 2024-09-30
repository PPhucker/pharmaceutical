<?php

namespace App\Services\Contractor\Address;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис мест осуществления деятельности.
 */
class PlaceOfBusinessService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param AddressServiceDependencies $addressServiceDependencies
     */
    public function __construct(AddressServiceDependencies $addressServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $addressServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->placeOfBusiness;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }
}
