<?php

namespace App\Policies\Contractor;

use App\Models\Contractor\ContactPerson;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика контактного лица контрагента.
 */
class ContactPersonPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param ContactPerson $contactPerson
     */
    public function __construct(ContactPerson $contactPerson)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($contactPerson);
    }
}
