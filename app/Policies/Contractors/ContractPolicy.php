<?php

namespace App\Policies\Contractors;

use App\Models\Contractors\Contract;
use App\Policies\CorePolicy;

/**
 * Политика для договора с контрагентом.
 */
class ContractPolicy extends CorePolicy
{
    /**
     * @param Contract $contract
     */
    public function __construct(Contract $contract)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($contract);
    }
}
