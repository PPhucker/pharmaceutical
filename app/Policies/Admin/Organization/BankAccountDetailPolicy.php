<?php

namespace App\Policies\Admin\Organization;

use App\Models\Admin\Organization\BankAccountDetail;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для банковских реквизитов организации.
 */
class BankAccountDetailPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return BankAccountDetail::class;
    }

    /**
     * @return string[]
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
