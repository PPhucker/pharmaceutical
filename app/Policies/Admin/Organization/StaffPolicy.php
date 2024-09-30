<?php

namespace App\Policies\Admin\Organization;

use App\Models\Admin\Organization\Staff;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика сотрудника организации.
 */
class StaffPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Staff::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
