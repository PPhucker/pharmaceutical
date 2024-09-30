<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;

use App\Services\CrudService;

/**
 * Абстрактный сервис для типов.
 */
abstract class TypeService extends CrudService
{
    /**
     * @param TypeServiceDependencies $typeServiceDependencies
     */
    public function __construct(TypeServiceDependencies $typeServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $typeServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }
}
