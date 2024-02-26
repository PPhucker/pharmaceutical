<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Repositories\Classifier\Nomenclature\Product\EndProductRepository;
use App\Repositories\Classifier\Nomenclature\Product\InternationalNameOfEndProductRepository;
use App\Repositories\Classifier\Nomenclature\Product\OKPD2Repository;
use App\Repositories\Classifier\Nomenclature\Product\RegistrationNumberOfEndProductRepository;
use App\Services\Classifier\Nomenclature\Product\Type\TypeServiceDependencies;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей для конечного продукта.
 */
class EndProductServiceDependencies extends CoreDependencyService
{
    protected $relatedDependencies = [
        TypeServiceDependencies::class,
    ];

    /**
     * @param EndProductRepository                     $endProduct
     * @param InternationalNameOfEndProductRepository  $internationalName
     * @param OKPD2Repository                          $okpd2
     * @param RegistrationNumberOfEndProductRepository $registrationNumber
     */
    public function __construct(
        EndProductRepository $endProduct,
        InternationalNameOfEndProductRepository $internationalName,
        OKPD2Repository $okpd2,
        RegistrationNumberOfEndProductRepository $registrationNumber
    ) {
        $this->repositories = compact(
            'endProduct',
            'internationalName',
            'okpd2',
            'registrationNumber'
        );

        $this->registerRelatedDependencies();
    }
}
