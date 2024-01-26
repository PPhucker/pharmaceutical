<?php

namespace App\Policies\Contractor;

use App\Models\Contractor\ContactPerson;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика контактного лица контрагента.
 */
class ContactPersonPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return ContactPerson::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
