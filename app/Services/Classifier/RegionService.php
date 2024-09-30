<?php

namespace App\Services\Classifier;

/**
 * Сервис региона.
 */
class RegionService extends ClassifierService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $regions = $this->repositories->region->getAll();

        return compact('regions');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->region;
    }
}
