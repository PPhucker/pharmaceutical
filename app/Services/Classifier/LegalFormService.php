<?php

namespace App\Services\Classifier;

use App\Services\CrudService;

/**
 * Сервис классификатора орагнизационно правовых форм.
 */
class LegalFormService extends CrudService
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

        $this->selectedRepo = $this->repositories->legalForm;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $legalForms = $this->repositories->legalForm->getAll();

        return compact('legalForms');
    }
}
