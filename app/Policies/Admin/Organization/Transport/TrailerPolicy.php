<?php

namespace App\Policies\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Trailer;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для прицепа организации.
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
     * @return string[]
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
