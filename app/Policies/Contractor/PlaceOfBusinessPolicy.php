<?php

namespace App\Policies\Contractor;

use App\Models\Contractor\PlaceOfBusiness;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика для мест осуществления деятельности контрагента.
 */
class PlaceOfBusinessPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return PlaceOfBusiness::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
