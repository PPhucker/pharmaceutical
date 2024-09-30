<?php

namespace App\Policies\Classifier;

use App\Models\Classifier\Bank;
use App\Policies\CorePolicy;

/**
 * Политика классификатора банков.
 */
class BankPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Bank::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.bank', ['admin']);
    }
}
