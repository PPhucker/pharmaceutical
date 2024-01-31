<?php

namespace App\Policies\Admin\Organization;

use App\Models\Admin\Organization\Organization;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политики для организации.
 */
class OrganizationPolicy extends CorePolicy
{
    use SoftDeletes;

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
