<?php

namespace App\Policies\Contractors\Transport;

use App\Models\Contractors\Transport\Driver;
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
