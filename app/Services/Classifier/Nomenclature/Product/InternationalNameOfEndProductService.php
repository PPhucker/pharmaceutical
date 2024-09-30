<?php

namespace App\Services\Classifier\Nomenclature\Product;

/**
 * Сервис международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProductService extends EndProductRelationService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $internationalNames = $this->selectedRepo->getAll();

        return compact('internationalNames');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->internationalName;
    }
}
