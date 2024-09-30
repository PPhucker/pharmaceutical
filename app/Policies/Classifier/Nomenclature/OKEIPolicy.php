<?php

namespace App\Policies\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\OKEI;
use App\Policies\CorePolicy;

/**
 * Политика классификатора ОКЕИ.
 */
class OKEIPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return OKEI::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomeclature.okei', ['admin']);
    }
}
