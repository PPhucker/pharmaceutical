<?php

namespace App\Services\Classifier\Nomenclature\Product;

/**
 * Сервис классификатора ОКПД2.
 */
class OKPD2Service extends EndProductRelationService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $okpd2Classifier = $this->selectedRepo->getAll();

        return compact('okpd2Classifier');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->okpd2;
    }
}
