<?php

namespace App\Policies\Contractors;

use App\Models\Contractors\Contractor;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика контрагента.
 */
class ContractorPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param Contractor $contractor
     */
    public function __construct(Contractor $contractor)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($contractor);
    }
}
