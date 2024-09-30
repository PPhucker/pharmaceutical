<?php

namespace App\Policies\Admin\Organization;

use App\Models\Admin\Organization\Organization;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политики для организации.
 */
class OrganizationPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Organization::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
