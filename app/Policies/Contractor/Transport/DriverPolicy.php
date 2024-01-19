<?php

namespace App\Policies\Contractor\Transport;

use App\Models\Contractor\Transport\Driver;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика водителя контрагента.
 */
class DriverPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param Driver $driver
     */
    public function __construct(Driver $driver)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($driver);
    }
}
