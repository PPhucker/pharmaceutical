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
     * @param Trailer $trailer
     */
    public function __construct(Trailer $trailer)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($trailer);
    }
}
