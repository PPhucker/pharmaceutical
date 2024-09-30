<?php

namespace App\Policies\Contractor\Transport;

use App\Models\Contractor\Transport\Car;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика автомобиля контрагента.
 */
class CarPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }

    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
