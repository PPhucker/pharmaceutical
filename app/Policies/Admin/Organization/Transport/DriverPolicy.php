<?php

namespace App\Policies\Admin\Organization\Transport;


use App\Models\Admin\Organization\Transport\Driver;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для водителя организации.
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
     * @return string[]
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
