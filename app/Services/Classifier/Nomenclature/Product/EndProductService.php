<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Services\Classifier\Nomenclature\NomenclatureServiceDependencies;
use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис конечного продукта.
 */
class EndProductService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param NomenclatureServiceDependencies $nomenclatureServiceDependencies
     * @param EndProductServiceDependencies   $productServiceDependencies
     */
    public function __construct(
        NomenclatureServiceDependencies $nomenclatureServiceDependencies,
        EndProductServiceDependencies $productServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $nomenclatureServiceDependencies,
                $productServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $endProducts = $this->repositories
            ->endProduct
            ->getAll();

        return compact('endProducts');
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function getEditData($model): array
    {
        return array_merge(
            [
                'endProduct' => $this->repositories
                    ->endProduct
                    ->getForEdit($model->id)
            ],
            $this->getCreateData()
        );
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            'types' => $this->repositories
                ->typeOfEndProduct
                ->getAll(false),
            'internationalNames' => $this->repositories
                ->internationalName
                ->getAll(false),
            'registrationNumbers' => $this->repositories
                ->registrationNumber
                ->getAll(false),
            'okeiClassifier' => $this->repositories
                ->okei
                ->getAll(),
            'okpd2Classifier' => $this->repositories
                ->okpd2
                ->getAll(),
        ];
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->endProduct;
    }
}
