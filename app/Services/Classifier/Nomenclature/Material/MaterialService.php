<?php

namespace App\Services\Classifier\Nomenclature\Material;

use App\Repositories\Classifier\Nomenclature\Material\MaterialRepository;
use App\Services\Classifier\Nomenclature\NomenclatureServiceDependencies;
use App\Services\Classifier\Nomenclature\Product\Type\TypeServiceDependencies;
use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис комплектующего.
 */
class MaterialService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param NomenclatureServiceDependencies $nomenclatureServiceDependencies
     * @param TypeServiceDependencies         $typeServiceDependencies
     */
    public function __construct(
        NomenclatureServiceDependencies $nomenclatureServiceDependencies,
        TypeServiceDependencies $typeServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $nomenclatureServiceDependencies,
                $typeServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @inheritDoc
     */
    protected function selectRepository(): object
    {
        return app(MaterialRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function getIndexData(): array
    {
        $materials = $this->selectedRepo->getAll(true);

        return compact('materials');
    }

    /**
     * @inheritDoc
     */
    public function getEditData($model): array
    {
        return array_merge(
            ['material' => $this->selectedRepo->getForEdit($model->id)],
            $this->getCreateData()
        );
    }

    /**
     * @inheritDoc
     */
    public function getCreateData(): array
    {
        $okeiClassifier = $this->repositories->okei->getAll();
        $typesOfMaterials = $this->repositories->typeOfMaterial->getAll();

        return compact('okeiClassifier', 'typesOfMaterials');
    }
}
