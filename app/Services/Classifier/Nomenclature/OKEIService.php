<?php

namespace App\Services\Classifier\Nomenclature;

/**
 * Сервис классификатора OKEI.
 */
class OKEIService extends NomenclatureService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $okeiClassifier = $this->repositories->okei->getAll();

        return compact('okeiClassifier');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->okei;
    }
}
