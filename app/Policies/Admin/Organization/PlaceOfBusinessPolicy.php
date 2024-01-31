<?php

namespace App\Policies\Admin\Organization;

use App\Models\Admin\Organization\PlaceOfBusiness;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для места осущетвления деятельности контрагента.
 */
class PlaceOfBusinessPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return PlaceOfBusiness::class;
    }

    /**
     * @return string[]
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
