<?php

namespace App\Policies\Contractors;

use App\Models\Contractors\PlaceOfBusiness;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для мест осуществления деятельности контрагента.
 */
class PlaceOfBusinessPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param PlaceOfBusiness $placeOfBusiness
     */
    public function __construct(PlaceOfBusiness $placeOfBusiness)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($placeOfBusiness);
    }
}
