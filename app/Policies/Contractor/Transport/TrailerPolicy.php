<?php

namespace App\Policies\Contractor\Transport;

use App\Models\Contractor\Transport\Trailer;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика прицепа контрагента.
 */
class TrailerPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Trailer::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
