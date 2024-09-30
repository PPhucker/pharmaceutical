<?php

namespace App\Services\Classifier;

/**
 * Сервис классификатора орагнизационно правовых форм.
 */
class LegalFormService extends ClassifierService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $legalForms = $this->repositories->legalForm->getAll();

        return compact('legalForms');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->legalForm;
    }
}
