<?php

namespace App\Policies\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\Service;
use App\Policies\CorePolicy;

/**
 * Политика услуги.
 */
class ServicePolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Service::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.service', ['admin']);
    }
}
