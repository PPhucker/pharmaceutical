<?php

namespace App\Policies\Contractors\Transport;

use App\Models\Contractors\Transport\Car;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика автомобиля контрагента.
 */
class CarPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @param Car $car
     */
    public function __construct(Car $car)
    {
        $this->roles = config('roles.contractor', ['admin']);

        parent::__construct($car);
    }
}
