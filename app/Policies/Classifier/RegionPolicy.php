<?php

namespace App\Policies\Classifier;


use App\Models\Classifier\Region;
use App\Policies\CorePolicy;

/**
 * Политика для регионов.
 */
class RegionPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Region::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.region', ['admin']);
    }
}
