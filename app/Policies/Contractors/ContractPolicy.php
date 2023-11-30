<?php

namespace App\Policies\Contractors;

use App\Models\Contractors\Contract;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика для договора с контрагентом.
 */
class ContractPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param Contract $contract
     */
    public function __construct(Contract $contract)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($contract);
    }
}
