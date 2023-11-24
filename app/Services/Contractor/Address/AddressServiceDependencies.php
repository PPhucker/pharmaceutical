<?php

namespace App\Services\Contractor\Address;

use App\Repositories\Contractors\Address\PlaceOfBusinessRepository;
use App\Repositories\Contractors\Address\RegionRepository;
use App\Services\Contractor\CoreDependencyService;

/**
 * Сервис зависимостей адреса контрагента.
 */
class AddressServiceDependencies extends CoreDependencyService
{
    /**
     * @param PlaceOfBusinessRepository $placeOfBusiness
     * @param RegionRepository          $region
     */
    public function __construct(
        PlaceOfBusinessRepository $placeOfBusiness,
        RegionRepository $region
    ) {
        $this->repositories = compact('placeOfBusiness', 'region');
    }
}
