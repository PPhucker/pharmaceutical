<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Admin\Organization\PlaceOfBusinessRepository;
use App\Services\Contractor\Address\AddressServiceDependencies;
use App\Services\Contractor\Address\PlaceOfBusinessService as ContractorPlaceOfBusinessService;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис места осуществления деятельности организации.
 */
class PlaceOfBusinessService extends ContractorPlaceOfBusinessService
{
    /**
     * @param AddressServiceDependencies $addressServiceDependencies
     *
     * @throws BindingResolutionException
     */
    public function __construct(AddressServiceDependencies $addressServiceDependencies)
    {
        parent::__construct($addressServiceDependencies);

        $this->repositories->placeOfBusiness = app()
            ->make(PlaceOfBusinessRepository::class);

        $this->selectedRepo = $this->repositories->placeOfBusiness;
    }
}
