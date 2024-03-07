<?php

namespace App\Services\Classifier;

use App\Services\CrudService;

/**
 * Сервис классификаторов.
 */
abstract class ClassifierService extends CrudService
{
    /**
     * @param ClassifierServiceDependencies $classifierServiceDependencies
     */
    public function __construct(ClassifierServiceDependencies $classifierServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $classifierServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }
}
