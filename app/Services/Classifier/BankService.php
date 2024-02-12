<?php

namespace App\Services\Classifier;

use App\Services\CrudService;

/**
 * Сервис классификатора банков.
 */
class BankService extends CrudService
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

        $this->selectedRepo = $this->repositories->bank;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $banks = $this->repositories->bank->getAll();

        return compact('banks');
    }
}
