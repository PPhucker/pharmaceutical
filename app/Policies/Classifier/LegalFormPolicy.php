<?php

namespace App\Policies\Classifier;

use App\Models\Classifier\LegalForm;
use App\Policies\CorePolicy;

/**
 * Политика классификатора организационно-правовых форм.
 */
class LegalFormPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return LegalForm::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.legal_form', ['admin']);
    }
}
