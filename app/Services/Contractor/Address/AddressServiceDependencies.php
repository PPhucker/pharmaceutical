<?php

namespace App\Services\Contractor\Address;

use App\Repositories\Contractor\Address\PlaceOfBusinessRepository;
use App\Repositories\Contractor\Address\RegionRepository;
use App\Services\CoreDependencyService;

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
