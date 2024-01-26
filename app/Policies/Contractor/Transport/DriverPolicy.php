<?php

namespace App\Policies\Contractor\Transport;

use App\Models\Contractor\Transport\Driver;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика водителя контрагента.
 */
class DriverPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Driver::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
