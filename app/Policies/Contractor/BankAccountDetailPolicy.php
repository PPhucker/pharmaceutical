<?php

namespace App\Policies\Contractor;

use App\Models\Contractor\BankAccountDetail;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

class BankAccountDetailPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param BankAccountDetail $bankAccountDetail
     */
    public function __construct(BankAccountDetail $bankAccountDetail)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($bankAccountDetail);
    }
}
