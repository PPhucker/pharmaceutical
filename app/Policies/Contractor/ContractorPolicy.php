<?php

namespace App\Policies\Contractor;

use App\Models\Contractor\Contractor;
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
